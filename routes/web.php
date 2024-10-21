<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\DashboardController;

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


Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard_home');
