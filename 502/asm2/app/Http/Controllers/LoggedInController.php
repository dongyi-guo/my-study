<?php

namespace App\Http\Controllers;

use DB;
use App\Models\EnergyProduct;
use App\Models\EnergyTransaction;
use App\Models\EnergyType;
use App\Models\FeeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Zone;
use App\Models\TradingPosition;
use Illuminate\Support\Facades\Auth;

class LoggedInController extends Controller
{
    # Dashboard
    # Navigate to the Dashboard
    public function dashboard() {
    	return view('logged.dashboard');
    }

    # Trading
    # Navigate to the Trading Page
    public function trading($id) {
        $user = User::find($id);
        $energy_products = EnergyProduct::where('zoneId', '=', $user->zoneId)->get();
    
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.trading', ['energy_products' => $energy_products]);
    }

    # Master Trading
    # Navigate to the Master Trading Page
    public function master_trading() {
        $energy_products = EnergyProduct::all();
    
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
    
        return view('logged.master-trading', ['energy_products' => $energy_products]);
    }

    # Navigate to the Product Creation Form
    public function create_product(){
        $users = User::where('isManager', '=', '0')->get();
        $energy_types = EnergyType::all();
        $zones = Zone::all();
    
        return view('logged.create-product', [
            'users' => $users,
            'energy_types' => $energy_types,
            'zones' => $zones
        ]);
    }

    # Navigate to the Product Editing Form
    public function edit_product($id){
        $product = EnergyProduct::find($id);
        $product->ownerName = User::find($product->ownerId)->userName;
        $product->typeName = EnergyType::find($product->energyTypeId)->typeName;
        $product->zoneName = Zone::find($product->zoneId)->zoneName;
        $energy_types = EnergyType::all();
        $zones = Zone::all();
    
        return view('logged.edit-product', [
            'product' => $product,
            'energy_types' => $energy_types,
            'zones' => $zones
        ]);
    }

    # Navigate to the Product Purchasing Form
    public function buy_product($id){
        $product = EnergyProduct::find($id);
    	$owner = User::find($product->ownerId);
        $product->ownerName = $owner->userName;
        $energy_types = EnergyType::all();
        $zones = Zone::all();
    
        return view('logged.buy-product', [
            'product' => $product,
        	'owner' => $owner,
            'energy_types' => $energy_types,
            'zones' => $zones
        ]);
    }

    # The purchasing action from the Product Purchasing Form
	public function SaveProductPurchase(Request $request) {
    	$message = "";
    	$productId = $request->productId;
    	$volume = $request->volume;
    	$feeId = $request->feeId;
    	$tradePrice = $request->tradePrice;
    	$tax = $request->tax;
    	$adminFee = $request->adminFee;
    
    	DB::beginTransaction();
        try 
        {
        	$product = EnergyProduct::find($productId);        
        	$user = User::find(Auth::user()->id);
        
        	if($user->balance < $tradePrice) {
            	$message = "Unsufficient balance.";
            	return response()->json(['data' => $message]);
            }
        
        	$product->volume = $product->volume - $volume;
        	$product->save();
        	
        	$user->balance = $user->balance - $tradePrice;
            $user->save();
        
        	$et = new EnergyTransaction;
        	$et->feeId = $feeId;
        	$et->buyerId = $user->id;
        	$et->sellerId = $product->ownerId;
        	$et->energyTypeId = $product->energyTypeId;
        	$et->zoneId = $product->zoneId;
        	$et->transactionDateTime = date('Y-m-d H:i:s');
        	$et->volume = $volume;
        	$et->tax = $tax;
        	$et->tradingPrice = $tradePrice;
        	$et->sellerReceivedPrice = $tradePrice - $adminFee;
        	$et->save();
        } 
        catch (\Exception $e) 
        {  
            $message = $e->getMessage();
            DB::rollBack();
        }
        DB::commit();
    
    	return response()->json(['data' => $message]);
    }

    # Navigate to the Product Selling Form
    public function sell_product(){
        $energy_types = EnergyType::all();
        $zones = Zone::all();
        return view('logged.sell-product', [
            'energy_types' => $energy_types,
            'zones' => $zones
        ]);
    }

    # Calcuate the Product's Price on the Product Purchasing Form
	public function CalculateProductPrice(Request $request) {
    	$productId = $request->productId;
    	$volume = $request->volume;
    
    	$product = EnergyProduct::find($productId);
    
    	$totalPrice = EnergyProduct::where('energyTypeId', $product->energyTypeId)->sum('sellerPrice');
    	$totalSeller = EnergyProduct::where('energyTypeId', $product->energyTypeId)->count();
    	$averagePrice = round(($totalPrice / $totalSeller), 2);
   
    	$lastFee = FeeHistory::orderby('feeDateTime', 'desc')->first();
    	$tax = round((($averagePrice * $volume) * ($lastFee->taxRate / 100)), 2);
    	$tradePrice = round((($averagePrice * $volume) + $lastFee->adminFee + $tax), 2);
    
    	return response()->json(['averagePrice' => $averagePrice, 'tax' => $tax, 'tradePrice' => $tradePrice, 'adminFee' => $lastFee->adminFee, 'taxRate' => $lastFee->taxRate, 'feeId' => $lastFee->id]);
    }

    # Store the newly created Product
    public function store(Request $request){
        $energy_product = new EnergyProduct;
        $energy_product->ownerId = $request->input('ownerId');
        $energy_product->energyTypeId = $request->input('energyTypeId');
        $energy_product->zoneId = $request->input('zoneId');
        $energy_product->volume = $request->input('volume');
        $energy_product->sellerPrice = $request->input('sellerPrice');
        $energy_product->save();
        $energy_products = EnergyProduct::all();
    
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
    
        return view('logged.master-trading', ['energy_products' => $energy_products]);
    }

    # The selling acction from the Product Selling Page
    public function sell(Request $request){
        $energy_product = new EnergyProduct;
        $energy_product->ownerId = $request->input('ownerId');
        $energy_product->energyTypeId = $request->input('energyTypeId');
        $energy_product->zoneId = $request->input('zoneId');
        $zoneId = $request->input('zoneId');
        $energy_product->volume = $request->input('volume');
        $energy_product->sellerPrice = $request->input('sellerPrice');
        $energy_product->save();
        $energy_products = EnergyProduct::where('zoneId', '=', $zoneId)->get();
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.trading', ['energy_products' => $energy_products]);
    }

    # The editing action from the Product Editing Form
    public function update(Request $request){
        $energy_product = EnergyProduct::find($request->input('id'));
        $energy_product->ownerId = $request->input('ownerId');
        $energy_product->energyTypeId = $request->input('energyTypeId');
        $energy_product->zoneId = $request->input('zoneId');
        $energy_product->volume = $request->input('volume');
        $energy_product->sellerPrice = $request->input('sellerPrice');
        $energy_product->save();
        $energy_products = EnergyProduct::all();
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.master-trading', ['energy_products' => $energy_products]);
    }

    # Naviagate to the Product Deletion Page
    public function delete_product($id) {
        $energy_product = EnergyProduct::find($id);
        $energy_product->delete();
        $energy_products = EnergyProduct::all();
        foreach ($energy_products as $entry) {
            $entry->ownerName = User::find($entry->ownerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.master-trading', ['energy_products' => $energy_products]);
    }

    # Price Management
    # Navigate to the Fee Page
    public function manage_fee() {
        return view('logged.fee');
    }

    # User Management
    # Navigate to the User Management Page
    public function manage_user() {
        $users = User::where('isManager','!=','1')->get();
        foreach ($users as $user) {
            $user->zoneName = Zone::find($user->zoneId)->zoneName;
            $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        }
        return view('logged.user-management', ['users' => $users]);
    }

    # Navigate to the User Creation Form
    public function user_create(){
        $trading_positions = TradingPosition::all();
        $zones = Zone::all();
        return view('logged.create-user', [
            'trading_positions' => $trading_positions,
            'zones' => $zones
        ]);
    }

    # The User Creating Action from the User Creation Form
    public function store_user(Request $request){
        $user = new user;
        $user->userName = $request->input('userName');
        $user->email = $request->input('email');
        $user->tradingPositionId = $request->input('tpd');
        $user->zoneId = $request->input('zoneId');
        $user->passwd = Hash::make($request->input('passwd'));
        $user->postalAddress = $request->input('postalAddress');
        $user->balance = $request->input('balance');
        $user->isActive = 1;
        $user->isManager = 0;
        $user->save();
        $users = User::where('isManager','!=','1')->get();
        foreach ($users as $user) {
            $user->zoneName = Zone::find($user->zoneId)->zoneName;
            $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        }
        return view('logged.user-management', ['users' => $users]);
    }

    # Activate an account
    public function user_active($id) {
        $user = User::find($id);
        $user->isActive = 1;
        $user->save();
        return redirect('/logged/user-management');
    }

    # Deactivate an account
    public function user_deactive($id) {
        $user = User::find($id);
        $user->isActive = 0;
        $user->save();
        return redirect('/logged/user-management');
    }

    # The action of deleting a user
    public function user_delete($id) {
        $user = User::find($id);
        $energy_products = EnergyProduct::where('ownerId', '=', $id);
        $energy_transactions = EnergyTransaction::where('buyerId', '=', $id)->orwhere('sellerId','=',$id);
        foreach ($energy_transactions as $energy_transaction) {
            $energy_transaction->delete();
        }
        foreach ($energy_products as $energy_product) {
            $energy_product->delete();
        }
        $user->delete();
        return redirect('/logged/user-management');
    }

    # Profile Management
    # Navigate to the Profile Page
    public function manage_profile($id) {
        $user = User::find($id);
        $user->zoneName = Zone::find($user->zoneId)->zoneName;
        $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        $zones = Zone::all();
        $roles = TradingPosition::all();
        $trading_history = EnergyTransaction::where('buyerId', '=', $id)->orwhere('sellerId','=',$id)->get();
        foreach ($trading_history as $entry) {
            $entry->buyerName = User::find($entry->buyerId)->userName;
            $entry->sellerName = User::find($entry->sellerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.profile', [
            'user' => $user,
            'zones' => $zones,
            'roles' => $roles,
            'trading_history' => $trading_history
        ]);
    }

    # The editing action of edit a profile
    public function update_profile(Request $request) { 
        $user = User::find($request->input('id'));
        $user->postalAddress = $request->input('postalAddress');
        $user->tradingPositionId = $request->input('tradingPositionId');
        $user->zoneId = $request->input('zoneId');
        if ($request->input('passwd') != "") {
            $user->passwd = Hash::make($request->input('passwd'));
        }
        $user->save();
        $user->zoneName = Zone::find($user->zoneId)->zoneName;
        $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        $zones = Zone::all();
        $roles = TradingPosition::all();
        $trading_history = EnergyTransaction::where('buyerId', '=', $user->id)->orwhere('sellerId','=', $user->id)->get();
        foreach ($trading_history as $entry) {
            $entry->buyerName = User::find($entry->buyerId)->userName;
            $entry->sellerName = User::find($entry->sellerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.profile', [
            'user' => $user,
            'zones' => $zones,
            'roles' => $roles,
            'trading_history' => $trading_history
        ]);
    }

    # The action of topping up to the user balance
    public function top_up (Request $request, $id) {
        $user = User::find($id);
        $money = $request->input('money');
        $user->balance = $user->balance + $money;
        $user->save();
        $user->zoneName = Zone::find($user->zoneId)->zoneName;
        $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        $zones = Zone::all();
        $roles = TradingPosition::all();
        $trading_history = EnergyTransaction::where('buyerId', '=', $id)->orwhere('sellerId','=',$id)->get();
        foreach ($trading_history as $entry) {
            $entry->buyerName = User::find($entry->buyerId)->userName;
            $entry->sellerName = User::find($entry->sellerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.profile', [
            'user' => $user,
            'zones' => $zones,
            'roles' => $roles,
            'trading_history' => $trading_history
        ]);
    }

    # The action of withdrawing from the balance
    public function withdraw (Request $request, $id) {
        $user = User::find($id);
        $money = $request->input('money');
        $user->balance = $user->balance - $money;
        $user->save();
        $user->zoneName = Zone::find($user->zoneId)->zoneName;
        $user->roleName = TradingPosition::find($user->tradingPositionId)->title;
        $zones = Zone::all();
        $roles = TradingPosition::all();
        $trading_history = EnergyTransaction::where('buyerId', '=', $id)->orwhere('sellerId','=',$id)->get();
        foreach ($trading_history as $entry) {
            $entry->buyerName = User::find($entry->buyerId)->userName;
            $entry->sellerName = User::find($entry->sellerId)->userName;
            $entry->typeName = EnergyType::find($entry->energyTypeId)->typeName;
            $entry->zoneName = Zone::find($entry->zoneId)->zoneName;
        }
        return view('logged.profile', [
            'user' => $user,
            'zones' => $zones,
            'roles' => $roles,
            'trading_history' => $trading_history
        ]);
    }


    # Retrieve Transanction Details for Dashboard
	public function GetHomeTransactionDetails() {
    	$dateList = EnergyTransaction::orderBy('transactionDateTime', 'desc')->take(5)->pluck('transactionDateTime')->toArray();  
    	$windList = [0, 0, 0, 0, 0];
    	$solarList = [0, 0, 0, 0, 0];
    	$index=0;
    
    	foreach ($dateList as $date) {
        	$et = EnergyTransaction::where(['transactionDateTime' => $date, 'energyTypeId' => 1])->first();
            
            if($et) {
            	$windList[$index] = $et->volume;
            }
                                           
            $et = EnergyTransaction::where(['transactionDateTime' => $date, 'energyTypeId' => 2])->first();
            
            if($et) {
            	$solarList[$index] = $et->volume;
            }
                                           
            $index++;
		}
        
    	return response()->json(['dateList' => $dateList, 'windList' => $windList, 'solarList' => $solarList]);
    }

    # Retrieve Transanction Summary for Dashboard
	public function GetHomeTradingSummary() {
    	$wind = EnergyTransaction::where('energyTypeId', 1)->sum('tradingPrice');
    	$solar = EnergyTransaction::where('energyTypeId', 2)->sum('tradingPrice');
        
    	return response()->json(['wind' => $wind, 'solar' => $solar]);
    }

    # Retrieve Fee Details for Dashboard
	public function GetServiceChargeAndTax() {
    	$dateList = EnergyTransaction::orderBy('transactionDateTime', 'desc')->take(5)->pluck('transactionDateTime')->toArray();  
    	$taxList = [0, 0, 0, 0, 0];
    	$priceList = [0, 0, 0, 0, 0];
    	$index=0;
    
    	foreach ($dateList as $date) {
        	$et = EnergyTransaction::where('transactionDateTime', $date)->sum('tax');
            
            if($et) {
            	$taxList[$index] = $et;
            }
                                           
            $et = EnergyTransaction::where('transactionDateTime', $date)->sum('tradingPrice');
            
            if($et) {
            	$priceList[$index] = $et;
            }
                                           
            $index++;
		}
        
    	return response()->json(['dateList' => $dateList, 'taxList' => $taxList, 'priceList' => $priceList]);
    }

    # Retrieve User Information for Dashboard
	public function GetUserInformation() {
    	$buyer = User::where('tradingPositionId', 1)->count();
    	$seller = User::where('tradingPositionId', 2)->count();
    	$both = User::where('tradingPositionId', 3)->count();
    	$manager = User::where('isManager', 1)->count();
        
    	return response()->json(['buyer' => $buyer, 'seller' => $seller, 'both' => $both, 'manager' => $manager]);
    }
}
 
