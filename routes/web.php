<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductsController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'index'])->name('home');
// to products page

Route::get('/products',[ProductsController::class,'index'])->name('products.index');
Route::get('/product/{product:slug}',[ProductsController::class,'show'])->name('products.show');
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
