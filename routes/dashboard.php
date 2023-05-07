<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'middleware'=>'auth',
    'prefix'=>'dashboard',   // // شكل الرابط في ال url في البداية
    'as'=>'dashboard.' // دا هيكون اسم الراوت name (dashboard.categories.create)
],
    function (){
        Route::get('/',[DashboardController::class,'index'])
            ->name('dashboard');
        Route::resource('/categories',CategoriesController::class);
    });

/*Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function (){

});*/
?>
