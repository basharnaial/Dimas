<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Authentication routes (مسارات المصادقة)
    Route::post('login', [AuthController::class, 'login']);
    
    // Protected routes (مسارات محمية)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

    // Public endpoints (عامة)
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category:slug}', [CategoryController::class, 'show']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product:slug}', [ProductController::class, 'show']);

    Route::post('contact', [ContactController::class, 'store']);

    // Admin endpoints (إدارية - محمية)
    Route::middleware(['auth:sanctum', 'can:manage-catalog'])->group(function () {
        Route::post('categories', [CategoryController::class, 'store']);
        Route::match(['put', 'patch'], 'categories/{category:slug}', [CategoryController::class, 'update']);
        Route::delete('categories/{category:slug}', [CategoryController::class, 'destroy']);

        Route::post('products', [ProductController::class, 'store']);
        Route::match(['put', 'patch'], 'products/{product:slug}', [ProductController::class, 'update']);
        Route::delete('products/{product:slug}', [ProductController::class, 'destroy']);
    });
});


