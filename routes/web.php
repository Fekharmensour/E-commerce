<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/valid' , function (){
    return view('Email.validateSeller');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
