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
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\OrderUserController;
use App\Http\Controllers\customer\SocialiteController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\LoginMiddleware;

//Route cho admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OpinionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\TestController;
use App\Http\Controllers\admin\WarehouseController;
use App\Http\Controllers\admin\IngredientController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\RevenueController;
use App\Http\Controllers\admin\PolicyController;
use App\Http\Middleware\AdminMiddleware;



//Customer

Route::middleware([UserMiddleware::class])->group(function() {
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
    Route::get('/customer/policy',[PolicyController::class,'view'])
    ->name('policyView');
});

Route::middleware([LoginMiddleware::class,UserMiddleware::class])->group(function() {
    //Profile
    Route::get('/profile',[ProfileController::class,'index'])
    ->name('profileIndex');
    Route::get('/profile/update',[ProfileController::class,'update'])
    ->name('profileUpdate');
    Route::post('/profile/handleUpdate',[ProfileController::class,'handleUpdate'])
    ->name('handleUpdateProfile');

    //Order
    Route::get('/my-orders',[OrderUserController::class,'index'])
    ->name('orderUserIndex');
    Route::post('/my-orders/{id}',[OrderUserController::class,'detail'])
    ->name('orderUserDetail');
    Route::get('/history-orders',[OrderUserController::class,'history'])
    ->name('orderUserHistory');


    Route::post('/detail/review',[DetailController::class,'handleCreate'])
    ->name('createReview');
});



//Cart API
Route::get('/api',[CartController::class,'index']);
Route::post('api/add',[CartController::class,'add']);
Route::put('api/update/{id}',[CartController::class,'update']);
Route::post('api/delete/{id}',[CartController::class,'delete']);


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
    ->name('orderIndex');
    Route::post('/orders/detail/{id}',[OrderController::class,'detail'])
    ->name('orderDetail');
    Route::put('/orders/update/{id}',[OrderController::class,'update'])
    ->name('orderUpdate');

    //Kho
    
    Route::get('/warehouse',[WarehouseController::class,'index'])
    ->name('warehouseIndex');
    Route::get('/warehouse/create',[WarehouseController::class,'create'])
    ->name('warehouseCreate');
    Route::post('/warehouse/handleCreate',[WarehouseController::class,'handleCreate'])
    ->name('handleCreateWarehouse');
    Route::post('/warehouse/details/{id}',[WarehouseController::class,'details'])
    ->name('details');

    //Ingredient
    Route::get('/ingredients',[IngredientController::class,'index'])
    ->name('ingredientIndex');
    Route::get('/ingredients/create',[IngredientController::class,'create'])
    ->name('ingredientCreate');
    Route::post('/ingredients/handleCreata',[IngredientController::class,'handleCreate'])
    ->name('handleCreateIngredient');
    Route::post('/ingredients/update/{id}',[IngredientController::class,'update'])
    ->name('ingredientUpdate');
    Route::post('/ingredients/{id}',[IngredientController::class,'handleUpdate'])
    ->name('handleUpdateIngredient');
    Route::delete('/ingredients/{id}',[IngredientController::class,'delete'])
    ->name('ingredientDelete');


    //Recipe
    Route::get('/recipes',[RecipeController::class,'index'])
    ->name('recipeIndex');
    Route::get('/recipes/create/{id}',[RecipeController::class,'create'])
    ->name('recipeCreate');
    Route::post('/recipes/handleCreate/{id}',[RecipeController::class,'handleCreate'])
    ->name('handleCreateRecipe');
    Route::get('/recipes/detail/{id}',[RecipeController::class,'detail'])
    ->name('recipeDetail');
    Route::post('/recipes/update/{id}',[RecipeController::class,'update'])
    ->name('recipeUpdate');
    Route::post('/recipes/{id}',[RecipeController::class,'handleUpdate'])
    ->name('handleUpdateRecipe');
    Route::delete('/recipes/{id}',[RecipeController::class,'delete'])
    ->name('recipeDelete');

    //Review
    Route::get('/reviews',[ReviewController::class,'index'])
    ->name('reviewIndex');
    Route::get('/reviews/update/{id}',[ReviewController::class,'handleUpdate'])
    ->name('reviewUpdate');

    //Policy
    Route::get('/policy',[PolicyController::class,'index'])
    ->name('policyIndex');
    Route::get('/policy/create',[PolicyController::class,'create'])
    ->name('policyCreate');
    Route::post('/policy/handleCreate',[PolicyController::class,'handleCreate'])
    ->name('handleCreatePolicy');
    Route::post('/policy/update/{id}',[PolicyController::class,'update'])
    ->name('policyUpdate');
    Route::post('/policy/{id}',[PolicyController::class,'handleUpdate'])
    ->name('handleUpdatePolicy');
    Route::delete('/policy/{id}',[PolicyController::class,'delete'])
    ->name('policyDelete');


    //Revenue
    Route::get('/dashboard',[RevenueController::class,'index'])
    ->name('dashboard');
    


    //Test
    Route::get('/filter_products',[RevenueController::class,'filterProducts'])
    ->name('filter_products');
});

//Test
Route::get('/test',[TestController::class,'test']);

//Socialite login

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])
->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
->name('google.callback');

// Search Products
Route::get('search-products',[ShopController::class,'search'])->name('searchProduct');

Route::get('/api/nguyenlieu',[WarehouseController::class,'apiNguyenlieu']);
Route::get('/api/top5',[RevenueController::class,'filter'])
    ->name('filter');