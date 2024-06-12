<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\FeeHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function index()
    {
        return view('logged.fee');
    }

    public function ShowPrice($id)
    {
    	$feeList = FeeHistory::orderBy("feeDateTime", "desc")->get();
    	$columnName = '';
    	$tableBody = "<tbody>";
    
    	
    	if($id == 1) 
        {
        	$columnName = 'Market Price';
        
        	foreach($feeList as $fee) {
         	   $tableBody .= "<tr><td>" . $fee->managerId . "</td><td>" . $fee->feeDateTime . "</td><td>" . $fee->marketFee . "</td></tr>";
        	}
        }
    
    	if($id == 2) 
        {
        	$columnName = 'Administration Fees';
        
        	foreach($feeList as $fee) {
         	   $tableBody .= "<tr><td>" . $fee->managerId . "</td><td>" . $fee->feeDateTime . "</td><td>" . $fee->adminFee . "</td></tr>";
        	}
        }
    
    	if($id == 3) 
        {
        	$columnName = 'Tax Rate';
        
        	foreach($feeList as $fee) {
         	   $tableBody .= "<tr><td>" . $fee->managerId . "</td><td>" . $fee->feeDateTime . "</td><td>" . $fee->taxRate . "</td></tr>";
        	}
        }
    
    	$tableBody .= "</tbody></table>";
    	$str = "<table id='table1' class='table'><thead><tr><th scope='col'>Manager ID</th><th scope='col'>Datetime</th><th scope='col'>" . $columnName . "</th></tr></thead>";
    	$str .= $tableBody;
    
        return response()->json(['data' => $str]);
    }

	public function SaveMarketPrice(Request $request) 
    {
    	$id = $request->id;
    	$price = $request->price;
    
    	$lastFee = FeeHistory::orderby('feeDateTime', 'desc')->first();
    	$isIdOkay = true;
    	$message = "";
    	
    	$currentFee = new FeeHistory;
        $currentFee->managerId = Auth::User()->id;
        $currentFee->feeDateTime = date('Y-m-d H:i:s');
    
    	if($id == 1) 
        {
        	$currentFee->marketFee = $price;
        	$currentFee->adminFee = $lastFee->adminFee;
        	$currentFee->taxRate = $lastFee->taxRate;
        }    
    	else if($id == 2)
        {
        	$currentFee->marketFee = $lastFee->marketFee;
        	$currentFee->adminFee = $price;
        	$currentFee->taxRate = $lastFee->taxRate;
        }
    	else if($id == 3)
        {
        	$currentFee->marketFee = $lastFee->marketFee;
        	$currentFee->adminFee = $lastFee->adminFee;
        	$currentFee->taxRate = $price;
        }
    	else 
        {
        	$isIdOkay = false;
        }

    	if($isIdOkay)
        {
        	$currentFee->save();
        	$message = "";
        }
    	else 
        {
        	$message = "Invalid parameter.";
        }        
    
    	return response()->json(['data' => $message]);
    }

	public function GetCurrentPrice(Request $request) 
    {    
    	$lastFee = FeeHistory::orderby('feeDateTime', 'desc')->first();
    	$marketFee = $lastFee->marketFee;
        $adminFee = $lastFee->adminFee;
        $taxRate = $lastFee->taxRate;    
    
    	return response()->json(['marketFee' => $marketFee, 'adminFee' => $adminFee, 'taxRate' => $taxRate]);
    }
}
