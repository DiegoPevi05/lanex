<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/service/{id}', [WebController::class, 'service'])->name('service');
Route::get('/suppliers', [WebController::class, 'suppliers'])->name('suppliers');
Route::get('/supplier/{id}', [WebController::class, 'supplier'])->name('supplier');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/track', [WebController::class, 'track'])->name('track');
Route::get('/track-flight', [WebController::class, 'trackFlight'])->name('track-flight');

