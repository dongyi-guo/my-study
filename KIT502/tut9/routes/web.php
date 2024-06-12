<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MainPageController;

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

Route::get('/', [MainPageController::class, 'index'])->name('main');
Route::get('/about', [MainPageController::class, 'about'])->name('about');

Route::get('/users', function () {
    return 'Hey! Welcome my user!';
});

Route::get('/arrays', function () {
    return ['I', 'Love', 'Soonja'];
});

Route::get('/jsons', function () {
    return response() -> json([
        'unit' => 'kit502',
        'name' => 'Web Development',
        'topic' => 'Laravel'
    ]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/create', [ProductsController::class, 'store'])->name('store');
Route::post('/edit', [ProductsController::class, 'update'])->name('update');
Route::any('/products/create', [ProductsController::class, 'create'])->name('create');
Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('edit');
Route::post('/products/{id}', [ProductsController::class, 'destroy'])->name('destroy');
Auth::routes();

