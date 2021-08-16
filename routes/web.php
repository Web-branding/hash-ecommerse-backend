<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageproductController;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
