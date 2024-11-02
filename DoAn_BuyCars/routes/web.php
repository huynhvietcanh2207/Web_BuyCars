<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::get('/admin', [AdminController::class, 'indexAdmin']);
Route::get('/detail_admin', [AdminController::class, 'detail_admin'])->name('detail_admin');
