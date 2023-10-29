<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/{category:slug}', [HomeController::class, 'categoryItems'])->name('category.items');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('category.product');
Route::post('/products/{product}/checkout', [ProductController::class, 'checkout'])->name('category.product.checkout');

Route::post('/charge', [ProductController::class, 'charge']);
