<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Products Management
    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::patch('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('admin.products.toggle-status');
    Route::post('products/bulk-action', [AdminProductController::class, 'bulkAction'])->name('admin.products.bulk-action');

    // Categories Management
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories');
    Route::patch('categories/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])->name('admin.categories.toggle-status');
    Route::post('categories/bulk-action', [AdminCategoryController::class, 'bulkAction'])->name('admin.categories.bulk-action');
    Route::post('categories/reorder', [AdminCategoryController::class, 'reorder'])->name('admin.categories.reorder');
});
