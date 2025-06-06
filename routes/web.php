<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;

Route::get('/', [HomeController::class,'index'])
->name('home');
Route::get('/shop', [ShopController::class,'index'])
->name('shop');
Route::get('/contact', [ContactController::class,'index'])
->name('contact');
Route::get('/content', [ContentController::class,'index'])
->name('content');