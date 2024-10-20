<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_registerController;

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


