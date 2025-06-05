<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class,'index'])
->name('home');
Route::get('/shop', [ShopController::class,'index'])
->name('shop');
Route::get('/contact', [ContactController::class,'index'])
->name('contact');