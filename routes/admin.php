<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use Illuminate\Support\Facades\Route;

// Products Management
Route::resource('products', AdminProductController::class)->except(['show']);
Route::patch('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
Route::post('products/bulk-action', [AdminProductController::class, 'bulkAction'])->name('products.bulk-action');

// Categories Management
Route::resource('categories', AdminCategoryController::class)->except(['show']);
Route::patch('categories/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
Route::post('categories/bulk-action', [AdminCategoryController::class, 'bulkAction'])->name('categories.bulk-action');
Route::post('categories/reorder', [AdminCategoryController::class, 'reorder'])->name('categories.reorder');

// Contact Messages Management
Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
Route::post('contacts/bulk-action', [AdminContactController::class, 'bulkAction'])->name('contacts.bulk-action');
