<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Buyer\BuyerAuthController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [BuyerAuthController::class, 'register']);
Route::post('/login', [BuyerAuthController::class, 'login'])->name('login');


////////////////////  Profile
Route::middleware(['auth:sanctum'])->prefix('profile/')->group(function () {
    Route::get('', [BuyerAuthController::class, 'buyer']);
    Route::get('logout', [BuyerAuthController::class, 'logout']);
    Route::post('update', [BuyerController::class, 'updateProfile']);
    Route::post('updateImage', [BuyerController::class, 'updateImage']);
    Route::post('updateRole', [BuyerController::class, 'updateRole']);
    Route::post('resetPassword', [BuyerAuthController::class, 'update_Password']);

});


///////////////////////////// Brand
Route::get('brand/getBrands', [BrandController::class, 'index']);
Route::get('brand/showBrand/{brand}', [BrandController::class, 'showBrand']);
Route::middleware(['auth:sanctum'])->prefix('brand/')->group(function () {
    Route::post('store', [BrandController::class, 'store']);
    Route::get('disabledBrands' , [BrandController::class, 'disabledBrands']);
});


///////////////////// Seller
Route::get('/getSellers', [SellerController::class, 'index']);
Route::get('seller/showSeller/{seller}', [SellerController::class, 'showSeller']);
Route::middleware(['auth:sanctum'])->prefix('seller/')->group(function () {

});

//////////////////////////// Product
Route::get('/product/{product}', [ProductController::class, 'showProduct']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [ProductController::class, 'indexCategory']);
Route::middleware(['auth:sanctum'])->prefix('product/')->group(function () {
    Route::post('/storeProduct', [ProductController::class, 'store']);
});

//////////////////////   Cart
Route::middleware(['auth:sanctum'])->prefix('cart/')->group(function () {
    Route::post('addToCart', [CartController::class, 'addToCart']);
    Route::post('updateCart', [CartController::class, 'updateCart']);
    Route::delete('deleteCart/{cart_id}', [CartController::class, 'deleteCart']);
    Route::delete('clearCarts', [CartController::class, 'clearCart']);
    Route::get('getCarts', [CartController::class, 'getCarts']);
});


//////////////////// Admin
Route::get('/users' , [BuyerController::class, 'index']);
Route::post('/userUpdate' , [AdminController::class, 'updateUser']);
Route::put('/admin/validSeller/{seller}' , [AdminController::class, 'validateSeller']);
Route::get('/disabledSellers' , [AdminController::class, 'disabledSellers']);
Route::delete('/admin/users/{buyer}' , [AdminController::class, 'deleteUser']);
Route::put('/admin/rejectSeller/{seller}' , [AdminController::class, 'rejectSeller']);
Route::middleware(['auth:sanctum'])->prefix('admin/')->group(function () {

});
