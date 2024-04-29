<?php

use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Buyer\BuyerAuthController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [BuyerAuthController::class, 'register']);
Route::post('/login', [BuyerAuthController::class, 'login'])->name('login');

//Route::middleware(['auth:sanctum'])->post('/profile/updateImage', [BuyerController::class, 'updateImage']);
Route::middleware(['auth:sanctum'])->prefix('profile/')->group(function () {
    Route::get('', [BuyerAuthController::class, 'buyer']);
    Route::post('logout', [BuyerAuthController::class, 'logout']);
    Route::post('update', [BuyerController::class, 'updateProfile']);
    Route::post('updateRole', [BuyerController::class, 'updateRole']);
    Route::post('resetPassword', [BuyerAuthController::class, 'update_Password']);

});

Route::get('/getBrands', [BrandController::class, 'index']);
Route::middleware(['auth:sanctum'])->prefix('brand/')->group(function () {
    Route::get('showBrand/{brand}', [BrandController::class, 'showBrand']);
    Route::post('store', [BrandController::class, 'store']);
    Route::get('disabledBrands' , [BrandController::class, 'disabledBrands']);
});


Route::get('/getSellers', [SellerController::class, 'index']);
Route::middleware(['auth:sanctum'])->prefix('seller/')->group(function () {
    Route::get('showSeller/{seller}', [SellerController::class, 'showSeller']);
    Route::get('disabledSellers' , [SellerController::class, 'disabledSellers']);
});


Route::get('/product/{product}', [ProductController::class, 'showProduct']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [ProductController::class, 'indexCategory']);
Route::post('/storeProduct', [ProductController::class, 'store']);
Route::middleware(['auth:sanctum'])->prefix('product/')->group(function () {
//    Route::post('/storeProduct', [ProductController::class, 'store']);
});


Route::middleware(['auth:sanctum'])->prefix('cart/')->group(function () {
    Route::post('addToCart', [CartController::class, 'addToCart']);
    Route::post('updateCart', [CartController::class, 'updateCart']);
    Route::post('deleteCart', [CartController::class, 'deleteCart']);
    Route::delete('clearCarts', [CartController::class, 'clearCart']);
    Route::get('getCarts', [CartController::class, 'getCarts']);
});
