<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Product routes.
Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
Route::get('products/upload', [ProductController::class, 'upload'])->name('product.upload');
Route::get('product/{product:id}', [ProductController::class, 'show'])->name('product.show');
Route::get('product/{product:id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/{product:id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{product:id}', [ProductController::class, 'delete'])->name('product.delete');
Route::post('products/store', [ProductController::class, 'store'])->name('product.store');
Route::post('parse', [ProductController::class, 'parse']);
Route::get('/', function () { return view('welcome'); });
