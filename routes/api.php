<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 

Route::get('products', [ProductController::class, 'all']);
Route::get('products/{id}', [ProductController::class, 'find']);

Route::get('categories', [ProductCategoryController::class, 'all']);
Route::get('categories/{id}', [ProductCategoryController::class, 'find']);

Route::post('register', [UserController::class, 'register']);