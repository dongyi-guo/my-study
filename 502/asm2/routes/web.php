<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoggedInController;

// code by sachinj(668690)
use App\Http\Controllers\HomeSearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

# Logged In Dashboard
Route::get('/logged', [LoggedInController::class, 'dashboard'])->name('dashboard');

# Trading
Route::get('/logged/trading/{id}', [LoggedInController::class, 'trading'])->name('trading');
Route::get('/logged/sell-product', [LoggedInController::class, 'sell_product'])->name('sell-product');
Route::post('/sell-product', [LoggedInController::class, 'sell'])->name('sell');
Route::get('/logged/buy-product/{id}', [LoggedInController::class, 'buy_product'])->name('buy-product');
Route::post('/logged/buy-product/CalculateProductPrice', [LoggedInController::class, 'CalculateProductPrice'])->name('home_CalculateProductPrice');
Route::any('/logged/SaveProductPurchase', [LoggedInController::class, 'SaveProductPurchase'])->name('home_SaveProductPurchase');

# Master Trading
Route::get('/logged/master-trading', [LoggedInController::class, 'master_trading'])->name('master-trading');
Route::get('/logged/create-product', [LoggedInController::class, 'create_product'])->name('create-product');
Route::post('/create-product', [LoggedInController::class, 'store'])->name('store');
Route::get('/logged/edit-product/{id}', [LoggedInController::class, 'edit_product'])->name('edit-product');
Route::post('/edit-product', [LoggedInController::class, 'update'])->name('update');
Route::post('/logged/delete-product/{id}', [LoggedInController::class, 'delete_product'])->name('delete-product');

# User Management
Route::get('/logged/user-management', [LoggedInController::class, 'manage_user'])->name('user-management');
Route::get('/logged/user-create', [LoggedInController::class, 'user_create'])->name('user-create');
Route::post('/create-user', [LoggedInController::class, 'store_user'])->name('store_user');
Route::get('/logged/user-management/active/{id}', [LoggedInController::class, 'user_active'])->name('user-active');
Route::get('/logged/user-management/deactive/{id}', [LoggedInController::class, 'user_deactive'])->name('user-deactive');
Route::post('/logged/user-management/delete/{id}', [LoggedInController::class, 'user_delete'])->name('user-delete');

# Profile Management
Route::get('/logged/profile/{id}', [LoggedInController::class, 'manage_profile'])->name('profile');
Route::post('/logged/profile/update', [LoggedInController::class, 'update_profile'])->name('update-profile');
Route::post('/top-up/{id}', [LoggedInController::class, 'top_up'])->name('top-up');
Route::post('/withdraw/{id}', [LoggedInController::class, 'withdraw'])->name('withdraw');

# Price Management
// Route::get('/logged/fee', [LoggedInController::class, 'manage_fee'])->name('fee');

# routes by sachinj(668690)
Route::get('/', function(){
    return view('start.home');
});
Route::get('/home-terms', function(){
    return view('start.home-terms-conditions');
});
Route::get('/home-trading', [HomeSearchController::class, 'trading'])->name('home-trading');
Route::get('/home-about', function(){
    return view('start.home-about');
});
Route::get('/home-privacy', function(){
    return view('start.home-privacy');
});
Route::get('/home-search', [HomeSearchController::class, 'search'])->name('home-search');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'registration'])->name('register');
Route::post('validate_registration', [RegisterController::class, 'validate_registration'])->name('validate_registration');
Route::post('validate_login', [LoginController::class, 'validate_login'])->name('validate_login');
//only for testing purpose of home screen.
// Route::get('dashboard', [LoginController::class, 'dashboard']) -> name('home-dashboard');

Route::get('/GetHomeTransactionDetails', [LoggedInController::class, 'GetHomeTransactionDetails']) -> name('home-GetHomeTransactionDetails');
Route::get('/GetHomeTradingSummary', [LoggedInController::class, 'GetHomeTradingSummary']) -> name('home-GetHomeTradingSummary');
Route::get('/GetServiceChargeAndTax', [LoggedInController::class, 'GetServiceChargeAndTax']) -> name('home-GetServiceChargeAndTax');
Route::get('/GetUserInformation', [LoggedInController::class, 'GetUserInformation']) -> name('home-GetUserInformation');

// fee management
Route::get('/logged/fee', [FeeController::class, 'index'])->name('fee_management');
Route::get('/logged/ShowFeePrices/{id}', [FeeController::class, 'ShowPrice'])->name('fee_ShowFeePrices');
Route::post('/logged/SaveMarketPrice/', [FeeController::class, 'SaveMarketPrice'])->name('fee_SaveMarketPrice');
Route::get('/logged/GetCurrentPrice', [FeeController::class, 'GetCurrentPrice'])->name('fee_GetCurrentPrice');