<?php

use Illuminate\Support\Facades\Route;

//Route cho nguoi dung
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\ContactController;
use App\Http\Controllers\customer\ContentController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\TintucController;
use App\Http\Controllers\customer\DetailController;
use App\Http\Controllers\customer\CheckoutController;
use App\Http\Controllers\customer\LoginController;
use App\Http\Middleware\UserMiddleware;

//Route cho admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OpinionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Middleware\AdminMiddleware;




//Customer

Route::middleware([ UserMiddleware::class])->group(function() {

    Route::get('/', [HomeController::class,'index'])
    ->name('home');
    Route::get('/shop', [ShopController::class,'index'])
    ->name('shop');
    Route::get('/detail/{id}',[DetailController::class,'detail'])
    ->name('detail');
    Route::get('/contact', [ContactController::class,'index'])
    ->name('contact');
    Route::get('/content', [ContentController::class,'index'])
    ->name('content');
    Route::post('/contact/sendMail',[ContactController::class,'sendMail'])
    ->name('sendMail');
    Route::get('/customer/news',[TintucController::class,'index'])
    ->name('news');
    Route::get('/cart',[CartController::class,'showCart'])
    ->name('showCart');
    Route::get('/checkout',[CheckoutController::class,'index'])
    ->name('checkout');
    Route::get('/checkout',[CheckoutController::class,'index'])
    ->name('checkout');
    Route::post('checkout/finish',[CheckoutController::class,'finish'])
    ->name('checkout.finish');
});



//Cart API
Route::get('/api',[CartController::class,'index']);
Route::post('api/add',[CartController::class,'add']);
Route::put('api/update',[CartController::class,'update']);
Route::post('/api/delete/{id}',[CartController::class,'delete'])
->name('deleteAPI');


//Login
Route::get('/register',[LoginController::class,'register'])
->name('register');
Route::post('/createRegister',[LoginController::class,'handleCreate'])
->name('createRegister');
Route::get('/login',[LoginController::class,'index'])
->name('login');
Route::post('/handleLogin',[LoginController::class,'login'])
->name('handleLogin');
Route::get('/logout',[LoginController::class,'logout'])
->name('logout');




Route::middleware([ AdminMiddleware::class])->group(function() {
    Route::get('/dashboard', [DashboardController::class,'index'])
    ->name('dashboard');

    //Products
    Route::get('/products', [ProductController::class,'index'])
    ->name('productIndex');
    Route::get('/products/create', [ProductController::class,'create'])
    ->name('productCreate');
    Route::post('/product/handleCreate',[ProductController::class,'handleCreate'])
    ->name('handleCreateProduct');
    Route::post('/products/update/{id}', [ProductController::class,'update'])
    ->name('productUpdate');
    Route::post('/products/{id}', [ProductController::class,'handleUpdate'])
    ->name('handleUpdateProduct');
    Route::delete('/products/{id}',[ProductController::class,'delete'])
    ->name('productDelete');


    //Opinions
    Route::get('/opinions',[OpinionController::class,'index'])
    ->name('opinionIndex');
    Route::get('/opinions/create', [OpinionController::class,'create'])
    ->name('opinionCreate');
    Route::post('/opinions/handleCreate',[OpinionController::class,'handleCreate'])
    ->name('handleCreateOpinion');
    Route::post('/opinions/update/{id}', [OpinionController::class,'update'])
    ->name('opinionUpdate');
    Route::post('/opinions/{id}', [OpinionController::class,'handleUpdate'])
    ->name('handleUpdateOpinion');
    Route::delete('/opinions/{id}',[OpinionController::class,'delete'])
    ->name('opinionDelete');


    //User
    Route::get('/users',[UserController::class,'index'])
    ->name('userIndex');
    Route::get('/users/create', [UserController::class,'create'])
    ->name('userCreate');
    Route::post('/users/handleCreate',[UserController::class,'handleCreate'])
    ->name('handleCreateUser');
    Route::post('/users/update/{id}', [UserController::class,'update'])
    ->name('userUpdate');
    Route::post('/users/{id}', [UserController::class,'handleUpdate'])
    ->name('handleUpdateUser');
    Route::delete('/users/{id}',[UserController::class,'delete'])
    ->name('userDelete');


    //Category
    Route::get('/category',[CategoryController::class,'index'])
    ->name('categoryIndex');
    Route::get('/category/create', [CategoryController::class,'create'])
    ->name('categoryCreate');
    Route::post('/category/handleCreate',[CategoryController::class,'handleCreate'])
    ->name('handleCreateCategory');
    Route::post('/category/update/{id}', [CategoryController::class,'update'])
    ->name('categoryUpdate');
    Route::post('/category/{id}', [CategoryController::class,'handleUpdate'])
    ->name('handleUpdateCategory');
    Route::delete('/category/{id}',[CategoryController::class,'delete'])
    ->name('categoryDelete');


    //News
    Route::get('/news',[NewsController::class,'index'])
    ->name('newsIndex');
    Route::get('/news/create', [NewsController::class,'create'])
    ->name('newsCreate');
    Route::post('/news/handleCreate',[NewsController::class,'handleCreate'])
    ->name('handleCreateNews');
    Route::post('/news/update/{id}', [NewsController::class,'update'])
    ->name('newsUpdate');
    Route::post('/news/{id}', [NewsController::class,'handleUpdate'])
    ->name('handleUpdateNews');
    Route::delete('/news/{id}',[NewsController::class,'delete'])
    ->name('newsDelete');

    //Order
    Route::get('/orders',[OrderController::class,'index'])
    ->name('orders.index');
    Route::post('/orders/detail/{id}',[OrderController::class,'detail'])
    ->name('orders.detail');
    Route::put('/orders/update/{id}',[OrderController::class,'update'])
    ->name('orders.update');
});

//Dashboard Admin



