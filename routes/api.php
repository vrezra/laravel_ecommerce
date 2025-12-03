<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class,'index']);
Route::get('/products/{id}', [ProductController::class,'show']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/cart', [CartController::class, 'index']);

    Route::post('/cart/items', [CartItemController::class,'store']);
    Route::put('/cart/items/{id}', [CartItemController::class,'update']);
    Route::patch('/cart/items/{id}', [CartItemController::class,'update']);
    Route::delete('/cart/items/{id}', [CartItemController::class,'destroy']);

    Route::post('/logout', [AuthController::class,'logout']);
});
