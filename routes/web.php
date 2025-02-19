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
use App\Http\Controllers\TransportTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Web\BlogController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/service/{id}', [WebController::class, 'service'])->name('service');
Route::get('/suppliers', [WebController::class, 'suppliers'])->name('suppliers');
Route::get('/suppliers/api', [WebController::class, 'getSuppliers'])->name('suppliers.get');
Route::get('/supplier/{id}', [WebController::class, 'supplier'])->name('supplier');
Route::get('/supplier/products/api/{id}', [WebController::class, 'getSupplierProducts'])->name('supplier.get');
Route::get('/blog/{id}', [WebController::class, 'blog'])->name('blog');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [WebController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/track', [WebController::class, 'track'])->name('track');
Route::get('/quote', [WebController::class, 'quote'])->name('quote');
Route::post('/quote/submit', [WebController::class, 'QuoteForm'])->name('quote.submit');

Route::get('/track/order',[OrderController::class,'searchOrder'])->name('order.search');
Route::get('/track-flight', [WebController::class, 'trackFlight'])->name('track-flight');
Route::get('/set-language/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->back();
})->name('set-language');


Route::prefix('/dashboard')->middleware('auth')->group(function(){

    Route::get('/', [DashboardController::class, 'home'])->name('dashboard_home');
    Route::get('/get-orders', [DashboardController::class, 'getOrders'])->name('dashboard_home_orders');
    Route::get('/get-amount', [DashboardController::class, 'getOrdersAmount'])->name('dashboard_home_amount');

    Route::get('/history', [DashboardController::class, 'history'])->name('dashboard_history');
    Route::get('/billing', [DashboardController::class, 'billing'])->name('dashboard_billing');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard_profile');

    Route::get('/clients/search', [ClientController::class, 'searchByCompany']);

    Route::prefix('/client')->group(function(){
        Route::get('/', [ClientController::class, 'index'])->name('dashboard_client');
        Route::post('/form', [ClientController::class, 'renderForm'])->name('client.form');
        Route::post('/store', [ClientController::class, 'store'])->name('client.store');
        Route::put('/update/{id}', [ClientController::class, 'update'])->name('client.update');
        Route::delete('/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    });

    Route::prefix('/order')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('dashboard_order');
        Route::post('/form', [OrderController::class, 'renderForm'])->name('order.form');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
        Route::delete('/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
        // New route for sending the order status email
        Route::post('/update-status/{id}', [OrderController::class, 'updateOrder'])->name('order.update.status');
        Route::post('/email-order/{id}', [OrderController::class, 'emailOrder'])->name('order.email');
        Route::post('/restore/{id}', [OrderController::class, 'restore'])->name('order.restore');
        Route::get('/search-cities', [OrderController::class, 'SearchCityByCountry'])->name('search.city');
    });

    Route::prefix('/history')->group(function(){
        Route::get('/', [HistoryController::class, 'index'])->name('dashboard_history');
    });

    Route::prefix('/transport_type')->group(function(){
        Route::get('/', [TransportTypeController::class, 'index'])->name('dashboard_transport_type');
        Route::post('/form', [TransportTypeController::class, 'renderForm'])->name('transport_type.form');
        Route::post('/store', [TransportTypeController::class, 'store'])->name('transport_type.store');
        Route::put('/update/{id}', [TransportTypeController::class, 'update'])->name('transport_type.update');
        Route::delete('/destroy/{id}', [TransportTypeController::class, 'destroy'])->name('transport_type.destroy');
    });


    Route::prefix('/web')->group(function(){
        Route::get('/', [DashboardController::class, 'web'])->name('dashboard_web');

        Route::prefix('/blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('dashboard_web_blog');
            Route::post('/form', [BlogController::class, 'renderForm'])->name('blogs.form');
            Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');
            Route::put('/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
            Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
        });
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
