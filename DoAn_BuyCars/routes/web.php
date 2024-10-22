<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['prefix' => ''], function () {
    Route::get('/', [Controller::class, 'index'])->name('index');
});

Route::get('login', [Login_registerController::class, 'index'])->name('login');
Route::post('register', [Login_registerController::class, 'store'])->name('register');
Route::post('login', [Login_registerController::class, 'login'])->name('login.post');
Route::post('logout', [Login_registerController::class, 'logout'])->name('logout');
Route::post('cart/add/{id}', [CartItemController::class, 'addToCart'])->name('cart.add');
Route::get('products/{id}', [Controller::class, 'show'])->name('products.show');
Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
// Route::get('/cart/{id}',[CartItemController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/{id}', [CartItemController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/update', [CartItemController::class, 'updateCart'])->name('cart.update');
// 

// Route cho admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('admin.dashboard');
    // Thêm các route khác cho admin ở đây
});
