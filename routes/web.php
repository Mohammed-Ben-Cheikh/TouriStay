<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {return view('dashboard');})->name('dashboard');
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/Hébergements', [PropertyController::class, 'index'])->name('Hébergements.index');
    Route::get('/Hébergements/{Hébergement}', [PropertyController::class, 'show'])->name('Hébergements.show');
    Route::get('/Hébergements/create', [PropertyController::class, 'create'])->name('Hébergements.create');
    Route::post('/Hébergements/store', [PropertyController::class, 'store'])->name('Hébergements.store');
});
