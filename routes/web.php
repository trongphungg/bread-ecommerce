<?php

use Illuminate\Support\Facades\Route;

//Route cho nguoi dung
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\ContactController;
use App\Http\Controllers\customer\ContentController;
use App\Http\Controllers\customer\CartController;

//Route cho admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;

Route::get('/', [HomeController::class,'index'])
->name('home');
Route::get('/shop', [ShopController::class,'index'])
->name('shop');
Route::get('/contact', [ContactController::class,'index'])
->name('contact');
Route::get('/content', [ContentController::class,'index'])
->name('content');


Route::get('/dashboard', [DashboardController::class,'index'])
->name('dashboard');


Route::get('/product', [ProductController::class,'index'])
->name('productIndex');


Route::get('/product/create', [ProductController::class,'create'])
->name('productCreate');
Route::post('/product/handleCreate',[ProductController::class,'handleCreate'])
->name('handleCreateProduct');

Route::post('/product/update/{id}', [ProductController::class,'update'])
->name('productUpdate');

Route::post('/product/{id}', [ProductController::class,'handleUpdate'])
->name('handleUpdateProduct');

Route::delete('product/{id}',[ProductController::class,'delete'])
->name('productDelete');


//Cart API
Route::get('/api',[CartController::class,'index']);
Route::post('api/add',[CartController::class,'add']);