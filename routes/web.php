<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryGroupController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagGroupController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('categories', CategoryController::class);
Route::resource('category-groups', CategoryGroupController::class);
Route::resource('tags', TagController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('product-images', ProductImageController::class);
    Route::resource('tag-groups', TagGroupController::class);
    Route::resource('carts', CartController::class);
});

Route::prefix('search')->group(function () {
    Route::get('tags', [TagController::class, 'search'])->name('tags.search');
    Route::get('categories', [CategoryController::class, 'search'])->name('categories.search');
});

Route::resource('cart-details', CartDetailController::class);

require __DIR__.'/auth.php';
