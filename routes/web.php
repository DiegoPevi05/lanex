<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\DashboardController;

//Routes for Web
use App\Http\Controllers\Web\ReviewController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/service/{id}', [WebController::class, 'service'])->name('service');
Route::get('/suppliers', [WebController::class, 'suppliers'])->name('suppliers');
Route::get('/supplier/{id}', [WebController::class, 'supplier'])->name('supplier');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/track', [WebController::class, 'track'])->name('track');
Route::get('/quote', [WebController::class, 'quote'])->name('quote');
Route::get('/track-flight', [WebController::class, 'trackFlight'])->name('track-flight');
Route::get('/set-language/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->back();
})->name('set-language');


Route::prefix('/dashboard')->group(function(){

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
            Route::post('/store', [ReviewController::class, 'store'])->name('reviews.store');
            Route::put('/update/{id}', [ReviewController::class, 'update'])->name('reviews.update');
            Route::delete('/destroy/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        });
    });
});


