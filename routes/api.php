<?php

use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\SubDistrictController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sub-districts/search', [SubDistrictController::class, 'search']);
Route::get('/postal-codes/search', [PostalCodeController::class, 'search']);
