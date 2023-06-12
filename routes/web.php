<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('proses-login', [LoginController::class, 'authenticate'])->name('proses-login');
Route::get('register', [LoginController::class, 'register'])->name('register');
route::post('proses-register', [LoginController::class, 'registerProcess'])->name('proses-login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('homeadmin', [HomeAdminController::class, 'index'])->name('homeadmin');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::get('exportpdf', [UserController::class, 'exportpdf'])->name('exportpdf');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/order-index', 'index')->name('order-index');
    Route::get('/order-checkout', 'listCart')->name('order-checkout');
    Route::post('/order-to-cart', 'addTocart')->name('order-to-cart');
    Route::post('/order-udate-cart', 'updateCart')->name('order-update-cart');
    Route::post('/order-checkout-pay', 'orderCheckout')->name('order-pay');
    Route::get('/order-download/{id}', 'downloadPdf')->name('download-pdf');
});

Route::controller(PesananController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/pesanan-index', 'index')->name('pesanan.index');
        Route::patch('/pesanan-update/{id}', 'updatePesanan')->name('pesanan.update');
    });
});
