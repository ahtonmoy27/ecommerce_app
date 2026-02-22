<?php

use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Ecommerce App (SSO Client)
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [EcommerceController::class, 'home'])->name('home');
Route::get('/products', [EcommerceController::class, 'products'])->name('products');

// SSO routes
Route::get('/login', [SsoController::class, 'login'])->name('login');
Route::get('/sso/callback', [SsoController::class, 'callback'])->name('sso.callback');
Route::post('/logout', [SsoController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware('sso.auth')->group(function () {
    Route::get('/dashboard', [EcommerceController::class, 'dashboard'])->name('dashboard');
    Route::get('/cart', [EcommerceController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [EcommerceController::class, 'addToCart'])->name('cart.add');
});
