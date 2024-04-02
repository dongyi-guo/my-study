<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ComputerController;

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

// Show index page
Route::get('/', [IndexController::class, 'view'])->name('/');

// Search computer by brand
Route::post('/search', [ComputerController::class, 'search'])->middleware('auth');

// Show computer rental page
Route::get('/rental', [ComputerController::class, 'rent'])->name('rental')->middleware('auth');

// View a computer
Route::get('/view/{computer}', [ComputerController::class, 'view'])->middleware('auth');

// Create a new computer
Route::post('/createComputer', [ComputerController::class, 'create'])->middleware('auth');

// View create computer rental order page
Route::get('/rental/createRent/{computer}', [ComputerController::class, 'createRent'])->middleware('auth');

// Update computer renting status
Route::put('/rental/update/{computer}', [ComputerController::class, 'updateRent'])->middleware('auth');

// View return rented computers
Route::get('/return', [ComputerController::class, 'return'])->name('return')->middleware('auth');

// Return a rented computer
Route::put('/return/{computer}', [ComputerController::class, 'returnComputer'])->middleware('auth');

// Manage returned computers
Route::get('/return/manage', [ComputerController::class, 'returnManage'])->name('returnManage')->middleware('auth');

// Confirm the return computer
Route::put('/return/confirm/{computer}', [ComputerController::class, 'returnConfirm'])->middleware('auth');

// Show computer master page
Route::get('/master', [ComputerController::class, 'master'])->name('master')->middleware('auth');

// View computer edit page
Route::get('/master/edit/{computer}', [ComputerController::class, 'edit'])->middleware('auth');

// Update a computer
Route::put('/master/edit/{computer}', [ComputerController::class, 'update'])->middleware('auth');

// Delete a computer
Route::delete('/master/delete/{computer}', [ComputerController::class, 'delete'])->middleware('auth');

// Show user management page
Route::get('/user/manage', [UserController::class, 'userManage'])->name('userManage')->middleware('auth');

// Unblacklist a customer
Route::put('/user/manage/unblacklist/{user}', [UserController::class, 'unblacklist'])->middleware('auth');

// Delete a staff
Route::delete('/user/manage/delete/{user}', [UserController::class, 'delete'])->middleware('auth');

// Create a staff
Route::post('/user/manage/create', [UserController::class, 'create'])->middleware('auth');

// Show user registration page
Route::get('/registration', [UserController::class, 'register'])->name('registration');

// User login
Route::post('/login', [UserController::class, 'login'])->name('login');

// User logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// View user dashboard
Route::get('/user', [UserController::class, 'view'])->name('user')->middleware('auth');

// Create a new user
Route::post('/user', [UserController::class, 'store']);

// Customer charge balance
Route::put('/user/charge', [UserController::class, 'updateBalance'])->middleware('auth');

// View User Edit page
Route::get('/user/edit/{user}', [UserController::class, 'editUser'])->name('edit')->middleware('auth');

// Update User Details
Route::put('/user/edit/{user}', [UserController::class, 'updateUser'])->name('charge')->middleware('auth');

// View manager dashboard
Route::get('/manager', [UserController::class, 'viewManager'])->name('manager')->middleware('auth');
