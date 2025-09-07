<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Vue SPA Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// SEO - Sitemap
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])
    ->name('sitemap');

// Laravel Breeze Routes - Redirect to admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - accessible to all authenticated users
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    require __DIR__.'/admin.php';
});

require __DIR__.'/auth.php';

// Vue SPA Routes - MUST BE LAST!
// This catches all routes that don't match above and sends them to Vue
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api|admin|login|register|password|dashboard|profile|sitemap\.xml).*$')->name('spa');
