<?php

use Illuminate\Support\Facades\Route;

//Route cho nguoi dung
use App\Http\Controllers\customer\TrangchuController;
use App\Http\Controllers\customer\LienheController;
use App\Http\Controllers\customer\GiohangController;
use App\Http\Controllers\customer\ChitietsanphamController;
use App\Http\Controllers\customer\DathangController;
use App\Http\Controllers\customer\DangnhapController;
use App\Http\Controllers\customer\SocialiteController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\LoginMiddleware;

//Route cho admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SanphamController;
use App\Http\Controllers\admin\YkienController;
use App\Http\Controllers\admin\KhachhangController;
use App\Http\Controllers\admin\LoaisanphamController;
use App\Http\Controllers\admin\TintucController;
use App\Http\Controllers\admin\DonhangController;
use App\Http\Controllers\admin\TestController;
use App\Http\Controllers\admin\NhapkhoController;
use App\Http\Controllers\admin\NguyenlieuController;
use App\Http\Controllers\admin\CongthucController;
use App\Http\Controllers\admin\DanhgiaController;
use App\Http\Controllers\admin\DoanhthuController;
use App\Http\Controllers\admin\ChinhsachController;
use App\Http\Middleware\AdminMiddleware;



//Customer

Route::middleware([UserMiddleware::class])->group(function() {
    Route::get('/', [TrangchuController::class,'index'])
    ->name('home');
    Route::get('/shop', [SanphamController::class,'view'])
    ->name('shop');
    Route::get('/detail/{id}',[ChitietsanphamController::class,'detail'])
    ->name('detail');
    Route::get('/contact', [LienheController::class,'index'])
    ->name('contact');
    Route::get('/content', [TintucController::class,'viewThongtinkhac'])
    ->name('content');
    Route::post('/contact/sendMail',[LienheController::class,'sendMail'])
    ->name('sendMail');
    Route::get('/customer/news',[TintucController::class,'viewCuahang'])
    ->name('news');
    Route::get('/cart',[GiohangController::class,'showCart'])
    ->name('showCart');
    Route::get('/checkout',[DathangController::class,'index'])
    ->name('checkout');
    Route::get('/checkout',[DathangController::class,'index'])
    ->name('checkout');
    Route::post('checkout/finish',[DathangController::class,'finish'])
    ->name('checkout.finish');
    Route::get('/customer/policy',[ChinhsachController::class,'view'])
    ->name('policyView');
});

Route::middleware([LoginMiddleware::class,UserMiddleware::class])->group(function() {
    //Profile
    Route::get('/profile',[KhachhangController::class,'indexUser'])
    ->name('profileIndex');
    Route::get('/profile/update',[KhachhangController::class,'updateUser'])
    ->name('profileUpdate');
    Route::post('/profile/handleUpdate',[KhachhangController::class,'handleUpdateUser'])
    ->name('handleUpdateProfile');

    //Order
    Route::get('/my-orders',[DonhangController::class,'view'])
    ->name('orderUserIndex');
    Route::post('/my-orders/{id}',[DonhangController::class,'detailUser'])
    ->name('orderUserDetail');
    Route::get('/history-orders',[DonhangController::class,'history'])
    ->name('orderUserHistory');


    Route::post('/detail/review',[ChitietsanphamController::class,'handleCreate'])
    ->name('createReview');
});



//Cart API
Route::get('/api',[GiohangController::class,'index']);
Route::post('api/add',[GiohangController::class,'add']);
Route::put('api/update/{id}',[GiohangController::class,'update']);
Route::post('api/delete/{id}',[GiohangController::class,'delete']);


//Login
Route::get('/register',[DangnhapController::class,'register'])
->name('register');
Route::post('/createRegister',[DangnhapController::class,'handleCreate'])
->name('createRegister');
Route::get('/login',[DangnhapController::class,'index'])
->name('login');
Route::post('/handleLogin',[DangnhapController::class,'login'])
->name('handleLogin');
Route::get('/logout',[DangnhapController::class,'logout'])
->name('logout');




Route::middleware([ AdminMiddleware::class])->group(function() {
    //Products
    Route::get('/products', [SanphamController::class,'index'])
    ->name('productIndex');
    Route::get('/products/create', [SanphamController::class,'create'])
    ->name('productCreate');
    Route::post('/product/handleCreate',[SanphamController::class,'handleCreate'])
    ->name('handleCreateProduct');
    Route::post('/products/update/{id}', [SanphamController::class,'update'])
    ->name('productUpdate');
    Route::post('/products/{id}', [SanphamController::class,'handleUpdate'])
    ->name('handleUpdateProduct');
    Route::delete('/products/{id}',[SanphamController::class,'delete'])
    ->name('productDelete');


    //Opinions
    Route::get('/opinions',[YkienController::class,'index'])
    ->name('opinionIndex');
    Route::get('/opinions/create', [YkienController::class,'create'])
    ->name('opinionCreate');
    Route::post('/opinions/handleCreate',[YkienController::class,'handleCreate'])
    ->name('handleCreateOpinion');
    Route::post('/opinions/update/{id}', [YkienController::class,'update'])
    ->name('opinionUpdate');
    Route::post('/opinions/{id}', [YkienController::class,'handleUpdate'])
    ->name('handleUpdateOpinion');
    Route::delete('/opinions/{id}',[YkienController::class,'delete'])
    ->name('opinionDelete');


    //User
    Route::get('/users',[KhachhangController::class,'index'])
    ->name('userIndex');
    Route::get('/users/create', [KhachhangController::class,'create'])
    ->name('userCreate');
    Route::post('/users/handleCreate',[KhachhangController::class,'handleCreate'])
    ->name('handleCreateUser');
    Route::post('/users/update/{id}', [KhachhangController::class,'update'])
    ->name('userUpdate');
    Route::post('/users/{id}', [KhachhangController::class,'handleUpdate'])
    ->name('handleUpdateUser');
    Route::delete('/users/{id}',[KhachhangController::class,'delete'])
    ->name('userDelete');


    //Category
    Route::get('/category',[LoaisanphamController::class,'index'])
    ->name('categoryIndex');
    Route::get('/category/create', [LoaisanphamController::class,'create'])
    ->name('categoryCreate');
    Route::post('/category/handleCreate',[LoaisanphamController::class,'handleCreate'])
    ->name('handleCreateCategory');
    Route::post('/category/update/{id}', [LoaisanphamController::class,'update'])
    ->name('categoryUpdate');
    Route::post('/category/{id}', [LoaisanphamController::class,'handleUpdate'])
    ->name('handleUpdateCategory');
    Route::delete('/category/{id}',[LoaisanphamController::class,'delete'])
    ->name('categoryDelete');


    //News
    Route::get('/news',[TintucController::class,'index'])
    ->name('newsIndex');
    Route::get('/news/create', [TintucController::class,'create'])
    ->name('newsCreate');
    Route::post('/news/handleCreate',[TintucController::class,'handleCreate'])
    ->name('handleCreateNews');
    Route::post('/news/update/{id}', [TintucController::class,'update'])
    ->name('newsUpdate');
    Route::post('/news/{id}', [TintucController::class,'handleUpdate'])
    ->name('handleUpdateNews');
    Route::delete('/news/{id}',[TintucController::class,'delete'])
    ->name('newsDelete');

    //Order
    Route::get('/orders',[DonhangController::class,'index'])
    ->name('orderIndex');
    Route::post('/orders/detail/{id}',[DonhangController::class,'detail'])
    ->name('orderDetail');
    Route::put('/orders/update/{id}',[DonhangController::class,'update'])
    ->name('orderUpdate');

    //Kho
    
    Route::get('/warehouse',[NhapkhoController::class,'index'])
    ->name('warehouseIndex');
    Route::get('/warehouse/create',[NhapkhoController::class,'create'])
    ->name('warehouseCreate');
    Route::post('/warehouse/handleCreate',[NhapkhoController::class,'handleCreate'])
    ->name('handleCreateWarehouse');
    Route::post('/warehouse/details/{id}',[NhapkhoController::class,'details'])
    ->name('details');

    //Ingredient
    Route::get('/ingredients',[NguyenlieuController::class,'index'])
    ->name('ingredientIndex');
    Route::get('/ingredients/create',[NguyenlieuController::class,'create'])
    ->name('ingredientCreate');
    Route::post('/ingredients/handleCreata',[NguyenlieuController::class,'handleCreate'])
    ->name('handleCreateIngredient');
    Route::post('/ingredients/update/{id}',[NguyenlieuController::class,'update'])
    ->name('ingredientUpdate');
    Route::post('/ingredients/{id}',[NguyenlieuController::class,'handleUpdate'])
    ->name('handleUpdateIngredient');
    Route::delete('/ingredients/{id}',[NguyenlieuController::class,'delete'])
    ->name('ingredientDelete');


    //Recipe
    Route::get('/recipes',[CongthucController::class,'index'])
    ->name('recipeIndex');
    Route::get('/recipes/create/{id}',[CongthucController::class,'create'])
    ->name('recipeCreate');
    Route::post('/recipes/handleCreate/{id}',[CongthucController::class,'handleCreate'])
    ->name('handleCreateRecipe');
    Route::get('/recipes/detail/{id}',[CongthucController::class,'detail'])
    ->name('recipeDetail');
    Route::post('/recipes/update/{id}',[CongthucController::class,'update'])
    ->name('recipeUpdate');
    Route::post('/recipes/{id}',[CongthucController::class,'handleUpdate'])
    ->name('handleUpdateRecipe');
    Route::delete('/recipes/{id}',[CongthucController::class,'delete'])
    ->name('recipeDelete');

    //Review
    Route::get('/reviews',[DanhgiaController::class,'index'])
    ->name('reviewIndex');
    Route::get('/reviews/update/{id}',[DanhgiaController::class,'handleUpdate'])
    ->name('reviewUpdate');

    //Policy
    Route::get('/policy',[ChinhsachController::class,'index'])
    ->name('policyIndex');
    Route::get('/policy/create',[ChinhsachController::class,'create'])
    ->name('policyCreate');
    Route::post('/policy/handleCreate',[ChinhsachController::class,'handleCreate'])
    ->name('handleCreatePolicy');
    Route::post('/policy/update/{id}',[ChinhsachController::class,'update'])
    ->name('policyUpdate');
    Route::post('/policy/{id}',[ChinhsachController::class,'handleUpdate'])
    ->name('handleUpdatePolicy');
    Route::delete('/policy/{id}',[ChinhsachController::class,'delete'])
    ->name('policyDelete');


    //Revenue
    Route::get('/dashboard',[DoanhthuController::class,'index'])
    ->name('dashboard');
    


    //Test
    Route::get('/filter_products',[DoanhthuController::class,'filterProducts'])
    ->name('filter_products');
});

//Test
Route::get('/test',[TestController::class,'test']);

//Socialite login

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])
->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
->name('google.callback');

//Facebook Login

Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook'])
->name('facebook.login');
Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback'])
->name('facebook.callback');
Route::get('auth/facebook/logout', [SocialiteController::class, 'logout'])
->name('facebook.callback');

// Search Products
Route::get('search-products',[SanphamController::class,'search'])->name('searchProduct');

Route::get('/api/nguyenlieu',[NhapkhoController::class,'apiNguyenlieu']);
Route::get('/api/top5',[DoanhthuController::class,'filter'])
    ->name('filter');


Route::post('vnpay_payment',[DathangController::class,'vnpay_payment'])
->name('vnpay_payment');

// Return vnpay
Route::get('/vnpay-return', [DathangController::class, 'vnpayReturn'])->name('vnpay.return');

Route::post('/api/phi',[DathangController::class, 'calculateShippingCost'])->name('phi');
Route::get('/api/test',[DathangController::class, 'test'])->name('test');