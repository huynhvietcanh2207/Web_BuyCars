<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserRoleAssignmentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserProfileController;
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

    Route::get('/account', [UserProfileController::class, 'showProfile'])->name('account.profile');

});


Route::get('login', [Login_registerController::class, 'index'])->name('login');
Route::post('register', [Login_registerController::class, 'store'])->name('register');
Route::post('login', [Login_registerController::class, 'login'])->name('login.post');
Route::post('logout', [Login_registerController::class, 'logout'])->name('logout');


// Route cho admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('admin');
    // Thêm các route khác cho admin ở đây
});
Route::resources([
    'products' => CrudProductsController::class,
]);
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

// Thương hiệu
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{BrandId}', [BrandController::class, 'show'])->name('brands.show');

Route::group(['prefix' => 'account'], function () {
    Route::get('/', [UserProfileController::class, 'showProfile'])->name('account.profile');
    Route::post('/update-avatar', [UserProfileController::class, 'updateAvatar'])->name('account.updateAvatar');
    Route::post('/update-account', [UserProfileController::class, 'updateAccount'])->name('account.updateAccount');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/', [RoleController::class, 'store'])->name('role.store'); // Thêm mới role
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update'); // Cập nhật role
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy'); // Xóa role

        Route::get('/assign', [UserRoleAssignmentController::class, 'create'])->name('role.assign');
        Route::post('/assign', [UserRoleAssignmentController::class, 'store'])->name('role.assign.store');
    });
});