<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CrudProductsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CrudBrandsController;

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
Route::post('cart/add/{id}', [CartItemController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartItemController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/update', [CartItemController::class, 'updateCart'])->name('cart.update');
Route::get('/detail', function () {
    return view('detail');
});

// Route cho admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('admin');
    // Thêm các route khác cho admin ở đây
    Route::get('/chart', [ChartController::class,'index'])->name('admin.chart.index');
    Route::get('/count-users', [ChartController::class, 'countUsersWithRole'])->name('count.users');
});
Route::resources([
    'products' => CrudProductsController::class,
    'brands' => CrudBrandsController::class,
]);

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
