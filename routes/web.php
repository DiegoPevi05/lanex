<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

//Routes for Web
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SupplierController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/service/{id}', [WebController::class, 'service'])->name('service');
Route::get('/suppliers', [WebController::class, 'suppliers'])->name('suppliers');
Route::get('/supplier/{id}', [WebController::class, 'supplier'])->name('supplier');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [WebController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/track', [WebController::class, 'track'])->name('track');
Route::get('/quote', [WebController::class, 'quote'])->name('quote');
Route::get('/track-flight', [WebController::class, 'trackFlight'])->name('track-flight');
Route::get('/set-language/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->back();
})->name('set-language');


Route::prefix('/dashboard')->middleware('auth')->group(function(){

    Route::get('/', [DashboardController::class, 'home'])->name('dashboard_home');
    Route::get('/services', [DashboardController::class, 'services'])->name('dashboard_services');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('dashboard_orders');
    Route::get('/transports', [DashboardController::class, 'transports'])->name('dashboard_transports');
    Route::get('/billing', [DashboardController::class, 'billing'])->name('dashboard_billing');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard_profile');
    Route::get('/config', [DashboardController::class, 'config'])->name('dashboard_config');


    Route::prefix('/web')->group(function(){
        Route::get('/', [DashboardController::class, 'web'])->name('dashboard_web');
        Route::prefix('/review')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('dashboard_web_review');
            Route::post('/form', [ReviewController::class, 'renderForm'])->name('reviews.form');
            Route::post('/store', [ReviewController::class, 'store'])->name('reviews.store');
            Route::put('/update/{id}', [ReviewController::class, 'update'])->name('reviews.update');
            Route::delete('/destroy/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        });
        Route::prefix('/service')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('dashboard_web_service');
            Route::post('/form', [ServiceController::class, 'renderForm'])->name('services.form');
            Route::post('/store', [ServiceController::class, 'store'])->name('services.store');
            Route::put('/update/{id}', [ServiceController::class, 'update'])->name('services.update');
            Route::delete('/destroy/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
        });

        Route::prefix('/product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('dashboard_web_product');
            Route::post('/form', [ProductController::class, 'renderForm'])->name('products.form');
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::prefix('/supplier')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('dashboard_web_supplier');
            Route::post('/form', [SupplierController::class, 'renderForm'])->name('suppliers.form');
            Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
            Route::put('/update/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
            Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        });
    });
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('showForgotPassword');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
