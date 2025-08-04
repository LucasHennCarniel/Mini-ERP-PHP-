<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

// Routes for Coupons
Route::resource('coupons', CouponController::class);

// Routes for Orders
Route::resource('orders', OrderController::class);

// Routes for Products
Route::resource('products', ProductController::class);

// Routes for Stocks
Route::resource('stocks', StockController::class);

// Rotas do carrinho
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

// Rotas do checkout
Route::get('checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('checkout/sucesso', [CheckoutController::class, 'success'])->name('orders.success');