<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagGroupController;
use App\Models\Product;
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

Route::get('/', function () {
    $products = Product::query()->orderBy('created_at', 'DESC')->paginate(24);
    return view('products.index', [
        'products' => $products,
    ]);
})->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');
    Route::resource('shipping-addresses', ShippingAddressController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-images', ProductImageController::class);
    Route::resource('tags', TagController::class);
    Route::resource('tag-groups', TagGroupController::class);
});

require __DIR__.'/auth.php';
