<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main Pages
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/products', 'products')->name('products.index');
Route::view('/services', 'services')->name('services.index');
Route::view('/contact', 'contact')->name('contact');

// Product Detail Pages
Route::prefix('products')->name('products.')->group(function () {
    Route::view('/medical-oxygen', 'products.medical-oxygen')->name('medical-oxygen');
    Route::view('/industrial-gas', 'products.industrial-gas')->name('industrial-gas');
    Route::view('/himalayan-oxygen', 'products.himalayan-oxygen')->name('himalayan-oxygen');
    Route::view('/emergency-oxygen', 'products.emergency-oxygen')->name('emergency-oxygen');
});

// Service Detail Pages
Route::prefix('services')->name('services.')->group(function () {
    Route::view('/bulk-supply', 'services.bulk-supply')->name('bulk-supply');
    Route::view('/cylinder-refilling', 'services.cylinder-refilling')->name('cylinder-refilling');
    Route::view('/equipment-rental', 'services.equipment-rental')->name('equipment-rental');
    Route::view('/maintenance', 'services.maintenance')->name('maintenance');
});
