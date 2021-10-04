<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageproductController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('home', [LoginController::class, 'login'])->name('login-admin');
Route::get('home', [LoginController::class, 'home'])->name('home');
Route::post('/', [LoginController::class, 'logout'])->name('logout');

Route::get('change-password', [ChangePasswordController::class, 'index'])->name('password.change');
Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');


Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/add-category', [CategoryController::class, 'add_fn'])->name('addcategory');
Route::post('/add-category', [CategoryController::class, 'add'])->name('add-category');
Route::get('category&{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('category&{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('delete', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/sub_category', [SubcategoryController::class, 'index'])->name('sub_category');
Route::get('/addsubcategory', [SubcategoryController::class, 'add_fn'])->name('addsubcategory');
Route::post('/addsubcategory', [SubcategoryController::class, 'add'])->name('add-subcategory');
Route::get('update&{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('update&{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
Route::delete('sub-delete', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/addproducts', [ProductController::class, 'add_fn'])->name('addproducts');
Route::post('/addproducts', [ProductController::class, 'add'])->name('add-products');
Route::get('product&{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('product&{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('product-view&{id}', [ProductController::class, 'view'])->name('product.view');
Route::delete('product-delete', [ProductController::class, 'destroy'])->name('product.destroy');

Route::delete('image-delete', [ImageproductController::class, 'imgdestroy'])->name('image.destroy');
Route::post('image-upload', [ImageproductController::class, 'imgupload'])->name('image.upload');
Route::delete('video-delete', [ImageproductController::class, 'videodestroy'])->name('video.destroy');
Route::post('video-upload', [ImageproductController::class, 'videoupload'])->name('video.upload');

Route::get('slide-list', [SlideController::class, 'index'])->name('slides.view');
Route::get('slide', [SlideController::class, 'slideadd'])->name('add.slide');
Route::post('slide', [SlideController::class, 'add_slide'])->name('slide.add');
Route::delete('delete-slide', [SlideController::class, 'destroy_slide'])->name('slide.destroy');


// Google login
Route::get('google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('order', [CategoryController::class, 'order'])->name('order');
Route::get('order&{id}', [CategoryController::class, 'details'])->name('details');
Route::match(['get', 'post'], 'status&{id}', [CategoryController::class, 'status'])->name('status');

Route::get('transaction', [CategoryController::class, 'transaction'])->name('transaction');

Route::get('download', [TransactionController::class, 'downloadPDF'])->name('download-orders');

//payment
Route::get('paywithrazorpay', [TransactionController::class,'payWithRazorpay'])->name('paywithrazorpay');
Route::post('payment', [TransactionController::class,'paymenttt'])->name('payment');