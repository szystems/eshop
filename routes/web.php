<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;

use App\Models\Order;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Shop Views
Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('view-category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview']);

Auth::routes();

Route::get('load-cart-data', [CartController::class, 'cartcount']);
Route::get('load-wish-data', [WishlistController::class, 'wishcount']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ajax cart options
Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('update-cart', [CartController::class, 'updatecart']);
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);

Route::post('add-to-wishlist', [WishlistController::class, 'add']);
Route::post('delete-wishlist-item', [WishlistController::class, 'deleteitem']);


Route::middleware(['auth'])->group(function () {
    //User Carts
    Route::get('cart', [CartController::class, 'viewcart']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    //User Orders
    Route::post('place-order', [CheckoutController::class, 'placeorder']);
    Route::get('my-orders', [UserController::class, 'indexorders']);
    Route::get('view-order/{id}', [UserController::class, 'showorder']);
    //User Dashboard
    Route::get('my-account', [UserController::class, 'indexuser']);
    Route::get('user-details/{id}', [UserController::class, 'showuser']);
    Route::get('user-edit/{id}', [UserController::class, 'edituser']);
    Route::put('user-update/{id}', [UserController::class, 'updateuser']);

    Route::get('wishlist', [WishlistController::class, 'index']);


});

//Admin Dashboard
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard','Admin\FrontendController@index');

    //Admin Category
    Route::get('categories',[CategoryController::class, 'index']);
    Route::get('show-category/{id}',[CategoryController::class, 'show']);
    Route::get('add-category', 'Admin\CategoryController@add');
    Route::post('insert-category','Admin\CategoryController@insert');
    Route::get('edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::get('delete-category/{id}', [CategoryController::class, 'destroy']);

    //Admin Products
    Route::get('products',[ProductController::class, 'index']);
    Route::get('show-product/{id}',[ProductController::class, 'show']);
    Route::get('add-product', 'Admin\ProductController@add');
    Route::post('insert-product','Admin\ProductController@insert');
    Route::get('edit-product/{id}',[ProductController::class,'edit']);
    Route::put('update-product/{id}', [ProductController::class, 'update']);
    Route::get('delete-product/{id}', [ProductController::class, 'destroy']);

    //Admin Users
    Route::get('users', [DashboardController::class, 'users']);
    Route::get('show-user/{id}', [DashboardController::class, 'showuser']);
    Route::get('add-user', 'Admin\DashboardController@adduser');
    Route::post('insert-user','Admin\DashboardController@insertuser');
    Route::get('edit-user/{id}',[DashboardController::class,'edituser']);
    Route::put('update-user/{id}', [DashboardController::class, 'updateuser']);
    Route::get('delete-user/{id}', [DashboardController::class, 'destroyuser']);

    //Admin Orders
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('admin/show-order/{id}', [OrderController::class, 'show']);
    Route::put('update-order/{id}', [OrderController::class, 'updateorder']);
    Route::get('order-history', [OrderController::class, 'orderhistory']);



 });
