<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// frontend routes
Route::get('/',[FrontendController::class, 'index'])->name("home.index");

//authenticated user cannot go to the login page.
Route::group(['middleware'=>'redirectifauthenticated'], function(){
    Route::get('/register',[BackendController::class, 'register'])->name("admin.register");
    Route::get('/login',[BackendController::class, 'login'])->name("admin.login");

});

Route::post('/register_user',[BackendController::class, 'registerUser'])->name("register.user");
Route::post('/login_user',[BackendController::class, 'loginUser'])->name("login.user");

Route::group(['middleware'=>'admin'], function(){
    Route::get('/admin',[BackendController::class, 'dashboard'])->name("admin.dashboard");
});

Route::get('/logoutUser', [BackendController::class, "logoutUser"])->name('logout.user');

Route::get('/single_product/{id}', [FrontendController::class, "singleProduct"])->name('single.product');


Route::get('/products', [BackendController::class, "product"])->name('admin.product');

//user notice upload 
Route::post('/products/upload',[BackendController::class, 'uploadProduct'])->name('products.upload');
//user notice update
Route::post('/products/update/{id}',[BackendController::class, 'updateProduct'])->name('products.update');
//user notice delete
Route::post('/products/delete',[BackendController::class, 'deleteProduct'])->name('delete.products');

Route::get('/products/paginate/paginate-data',[BackendController::class, 'paginationProduct']);





