<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FavoriteController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // tourist routes
    Route::get('/', [TouristController::class,'index'])->name('home');
    Route::get('/home', [TouristController::class,'index'])->name('home');
    Route::get('/blogs', function () {return view('blogs');})->name('blogs');
    Route::get('/hébergements', [PropertyController::class, 'index'])->name('hébergements.index');
    Route::get('/hébergements/{hébergement}', [PropertyController::class, 'show'])->name('hébergements.show');

    // Favorites routes
    Route::post('/favorites/{property}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // Owner routes
    Route::get('/become-an-owner', [OwnerController::class, 'welcome'])->name('become-an-owner');
    Route::post('/register-owner', [OwnerController::class, 'become_owner'])->name('register.owner');
    
    Route::middleware(['isOwner'])->group(function () {
        Route::get('/hébergement/create', [PropertyController::class, 'create'])->name('hébergements.create');
        Route::post('/hébergement/store', [PropertyController::class, 'store'])->name('hébergements.store');
        Route::get('/hébergement/{hébergement}/edit', [PropertyController::class, 'edit'])->name('hébergements.edit');
        Route::put('/hébergement/{hébergement}', [PropertyController::class, 'update'])->name('hébergements.update');
        Route::delete('/hébergement/{hébergement}', [PropertyController::class, 'destroy'])->name('hébergements.destroy');
        Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    });
});
