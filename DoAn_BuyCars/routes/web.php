<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserRoleAssignmentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CrudProductsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CrudBrandsController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CrudVoucherController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CrudCommentController;


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
    Route::get('/account', [UserProfileController::class, 'showProfile'])->name('account.profile');
});


Route::get('/product', [ProductController::class, 'showProducts'])->name('product');
Route::get('/product/filter', [ProductController::class, 'filter'])->name('product.filter');


Route::get('login', [Login_registerController::class, 'index'])->name('login');
Route::post('register', [Login_registerController::class, 'store'])->name('register');
Route::post('login', [Login_registerController::class, 'login'])->name('login.post');
Route::post('logout', [Login_registerController::class, 'logout'])->name('logout');
Route::post('cart/add/{id}', [CartItemController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartItemController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/update', [CartItemController::class, 'updateCart'])->name('cart.update');

// Route cho admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('admin');
    // Thêm các route khác cho admin ở đây
    Route::get('/chart', [ChartController::class, 'index'])->name('admin.chart.index');
    Route::get('/count-users', [ChartController::class, 'countUsersWithRole'])->name('count.users');
});

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Thương hiệu
Route::get('/brands', [BrandController::class, 'index'])->name('brands.indexBrand');
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brands.showBrand');
// Comment
Route::get('/detail/{id}', [DetailController::class, 'indexDetail'])->name('detail.index');
Route::post('/detail/{id}/comment', [DetailController::class, 'addComment'])->name('product.comment');

Route::group(['prefix' => 'account'], function () {
    Route::post('/update-avatar', [UserProfileController::class, 'updateAvatar'])->name('account.updateAvatar');
    Route::post('/update-account', [UserProfileController::class, 'updateAccount'])->name('account.updateAccount');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/', [RoleController::class, 'store'])->name('role.store'); // Thêm mới role
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update'); // Cập nhật role
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy'); // Xóa role

        Route::get('/assign', [UserRoleAssignmentController::class, 'create'])->name('role.assign');
        Route::post('/assign', [UserRoleAssignmentController::class, 'store'])->name('role.assign.store');
        Route::get('/list-assign', [UserRoleAssignmentController::class, 'index'])->name('role.list');
    });

    //
    Route::resources([
        'products' => CrudProductsController::class,
        'brands' => CrudBrandsController::class,
        'vouchers' => CrudVoucherController::class,
        'comments' => CrudCommentController::class,
    ]);
});