<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

    Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');

    // Route::get('/cart/{id}',[CartItemController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart/{id}', [CartItemController::class, 'destroy'])->name('cart.destroy');

    Route::put('/cart/update', [CartItemController::class, 'updateCart'])->name('cart.update');
});