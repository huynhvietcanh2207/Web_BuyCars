<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrudProductsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FavoriteController;

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

// Thêm và xoá yêu thích sản phẩm
Route::group(['middleware' => 'auth'], function () {
    Route::resource('favorites', FavoriteController::class);
    Route::post('/favorites/add/{productId}', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
    Route::post('/favorites/remove/{product}', [FavoriteController::class, 'remove'])->name('favorites.remove');
});


Route::get('login', [Login_registerController::class, 'index'])->name('login');
Route::post('register', [Login_registerController::class, 'store'])->name('register');
Route::post('login', [Login_registerController::class, 'login'])->name('login.post');
Route::post('logout', [Login_registerController::class, 'logout'])->name('logout');


// Route cho admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('admin.dashboard');
    // Thêm các route khác cho admin ở đây
});
Route::resources([
    'products' => CrudProductsController::class,
]);
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
