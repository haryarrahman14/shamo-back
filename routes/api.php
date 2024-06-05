<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'all']);
Route::get('products/{id}', [ProductController::class, 'find']);

Route::get('categories', [ProductCategoryController::class, 'all']);
Route::get('categories/{id}', [ProductCategoryController::class, 'find']);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('transactions', [TransactionController::class, 'all']);
});