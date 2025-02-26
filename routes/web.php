<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\OwnerController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {return view('home');})->name('home');
    Route::get('/home', function () {return view('home');})->name('home');
    Route::get('/blogs', function () {return view('blogs');})->name('blogs');
    Route::get('/hébergements', [PropertyController::class, 'index'])->name('hébergements.index');
    Route::get('/Hébergements/create', [PropertyController::class, 'create'])->name('Hébergements.create');
    Route::get('/Hébergements/{Hébergement}', [PropertyController::class, 'show'])->name('Hébergements.show');
    Route::post('/Hébergements/store', [PropertyController::class, 'store'])->name('Hébergements.store');

    // Owner routes
    Route::get('/Become-an-owner', [OwnerController::class, 'welcome'])->name('Become-an-owner');
    Route::post('/register-owner', [OwnerController::class, 'become_owner'])->name('register.owner');
    
    Route::middleware(['isOwner'])->group(function () {
        Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
        Route::get('/owner/properties', [OwnerController::class, 'properties'])->name('owner.properties');
        Route::get('/owner/earnings', [OwnerController::class, 'earnings'])->name('owner.earnings');
    });
});
