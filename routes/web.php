<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.shops.index')->with('status', session('status'));
    }

    return redirect()->route('admin.shops.index');
});
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('shop/{shop}', [HomeController::class,'show'])->name('shop');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class. 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    // Roles
    Route::delete('roles/destroy', [RolesController::class,'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', [UsersController::class,'massDestroy'])->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', [CategoriesController::class,'massDestroy'])->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Shops
    Route::delete('shops/destroy', [ShopsController::class,'massDestroy'])->name('shops.massDestroy');
    Route::post('shops/media', [ShopsController::class,'storeMedia'])->name('shops.storeMedia');
    Route::resource('shops', 'ShopsController');
});
