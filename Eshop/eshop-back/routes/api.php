<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product', [ProductController::class, 'getAll']);
Route::get('product/{product}', [ProductController::class, 'singleProduct']);


Route::middleware('auth:sanctum')->group(function () {
    // Route::get('cart', [CartController::class, 'show']);
    // Route::post('cart/{product}', [CartController::class, 'store']);
    Route::apiResource('cart', CartController::class)->only([
        'index', 'store'
    ]);
});
