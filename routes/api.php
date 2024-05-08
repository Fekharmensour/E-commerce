<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Buyer\BuyerAuthController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController;
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
    Route::get('notification', [BuyerController::class, 'Notification']);
    Route::delete('notification/{notification}', [BuyerController::class, 'DestroyNotification']);
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
    Route::delete('deleteCart/{cart}', [CartController::class, 'deleteCart']);
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


////////////////// Order
Route::middleware(['auth:sanctum'])->prefix('order/')->group(function () {
    // this for buyer
    Route::post('order', [OrderController::class, 'store']);
    Route::get('hisOrders', [OrderController::class, 'index']);
    Route::get('hisOrders/{order}', [OrderController::class, 'showOrder']);
    Route::get('acceptedHisOrders', [OrderController::class, 'acceptedHisOrders']);
    Route::get('rejectedHisOrders', [OrderController::class, 'rejectedHisOrders']);
    Route::get('waitingHisOrders', [OrderController::class, 'waitingHisOrders']);
    // this for seller
    Route::put('acceptOrder/{order}', [OrderController::class, 'acceptOrder']);
    Route::put('rejectOrder/{order}' , [OrderController::class , 'rejectOrder']);
    Route::get('sellerOrders', [OrderController::class, 'sellerIndex']);
    Route::get('sellerOrder/{order}', [OrderController::class, 'showSellerOrder']);
    Route::get('sellerAcceptedOrders', [OrderController::class, 'sellerAcceptedOrders']);
    Route::get('sellerRejectedOrders', [OrderController::class, 'sellerRejectedOrders']);
    Route::get('waitingOrders', [OrderController::class, 'waitingOrders']);


});
