<?php

use App\Http\Controllers\BuyerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BuyerAuthController;

Route::post('/register', [BuyerAuthController::class, 'register']);
Route::post('/login', [BuyerAuthController::class, 'login'])->name('login');

//Route::middleware(['auth:sanctum'])->post('/profile/updateImage', [BuyerController::class, 'updateImage']);
Route::middleware(['auth:sanctum'])->prefix('profile/')->group(function () {
    Route::get('', [BuyerAuthController::class, 'buyer']);
    Route::post('logout', [BuyerAuthController::class, 'logout']);
    Route::post('update', [BuyerController::class, 'updateProfile']);
    Route::post('resetPassword', [BuyerAuthController::class, 'update_Password']);
});

