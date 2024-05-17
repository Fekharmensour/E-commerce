<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Buyer\BuyerAuthController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Product\DiscountController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ReviewController;
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
    Route::get('stock', [SellerController::class, 'stock']);
    Route::get('stock/{product}', [SellerController::class, 'showStock']);

});

//////////////////////////// Product
Route::get('/product/{product}', [ProductController::class, 'showProduct']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [ProductController::class, 'indexCategory']);
Route::middleware(['auth:sanctum'])->prefix('product/')->group(function () {
    Route::post('storeProduct', [ProductController::class, 'store']);
    Route::post('updateProduct/{product}', [ProductController::class, 'update']);
    Route::post('updatePhotos/{product}', [ProductController::class, 'updatePhotos']);
    Route::delete('deleteProduct/{product}', [ProductController::class, 'destroy']);
    Route::post('complaint/{product}', [ComplaintController::class, 'ComplaintProd']);
});

////////////// Review
Route::get('review/{product}' , [ReviewController::class, 'index'] );
    Route::middleware(['auth:sanctum'])->prefix('review/')->group(function () {
    Route::post('{product}' , [ReviewController::class, 'store']);
    Route::post('update/{review}' ,[ReviewController::class, 'update'] );
    Route::delete('delete/{review}' ,[ReviewController::class, 'destroy'] );
    Route::get('test/{product}', [ReviewController::class, 'test'] );
    Route::post('complaint/{review}', [ComplaintController::class, 'ComplaintReview']);
});


//////////////////////   Cart
Route::middleware(['auth:sanctum'])->prefix('cart/')->group(function () {
    Route::post('addToCart', [CartController::class, 'addToCart']);
    Route::post('updateCart', [CartController::class, 'updateCart']);
    Route::delete('deleteCart/{cart}', [CartController::class, 'deleteCart']);
    Route::delete('clearCarts', [CartController::class, 'clearCart']);
    Route::get('getCarts', [CartController::class, 'getCarts']);
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
    Route::post('complaint/{order}', [ComplaintController::class, 'ComplaintBuyer']);
    Route::post('complaint/seller/{order}', [ComplaintController::class, 'ComplaintSeller']);
});

Route::middleware(['auth:sanctum'])->prefix('discount/')->group(function () {
    Route::get('{cart}' , [DiscountController::class, 'discounts']);
    Route::post('store' , [DiscountController::class , 'store']);
    Route::post('update/{discount}' , [DiscountController::class , 'update']);
    Route::delete('delete/{discount}' , [DiscountController::class , 'delete']);
    Route::post('activate/{discount}' , [DiscountController::class , 'active']);
    Route::put('deactivate/{cart}'   , [DiscountController::class , 'deactivate']);
    Route::post('searchCoupon' , [DiscountController::class , 'searchCoupon']);
    Route::post('activateCoupon/{coupon}' , [DiscountController::class , 'activateCoupon']);
});


//////////////////// Admin
Route::post('/admin/login' , [AdminController::class , 'login']);
Route::get('/users' , [BuyerController::class, 'index']);
Route::get('/disabledSellers' , [AdminController::class, 'disabledSellers']);
Route::middleware(['auth:sanctum'])->prefix('admin/')->group(function () {
    Route::post('/userUpdate' , [AdminController::class, 'updateUser']);
    Route::put('validSeller/{seller}' , [AdminController::class, 'validateSeller']);
    Route::delete('users/{buyer}' , [AdminController::class, 'deleteUser']);
    Route::put('rejectSeller/{seller}' , [AdminController::class, 'rejectSeller']);
});


Route::middleware(['auth:sanctum'])->prefix('admin/coupon/')->group(function () {
    Route::post('' , [CouponController::class , 'create']);
    Route::post('update/{coupon}' , [CouponController::class , 'update']);
    Route::delete('delete/{coupon}', [CouponController::class , 'delete']);
});

Route::middleware(['auth:sanctum'])->prefix('admin/complaint/')->group(function () {
    Route::get('buyers' , [ComplaintController::class , 'buyerIndex']);
    Route::get('sellers' , [ComplaintController::class , 'sellerIndex']);
    Route::get('reviews', [ComplaintController::class , 'reviewIndex'] );
    Route::get('products' , [ComplaintController::class , 'productIndex']);
    Route::delete('{complaint}' , [ComplaintController::class , 'delete']);
    Route::delete('review/{review}/{complaint}' , [ComplaintController::class , 'DeleteReview']);
    Route::delete('product/{product}/{complaint}' , [ComplaintController::class , 'DeleteProduct']);
    Route::delete('buyer/{buyer}/{complaint}' , [ComplaintController::class , 'DeleteBuyer']);
    Route::delete('seller/{seller}/{complaint}' , [ComplaintController::class , 'DisableSeller']);
});

