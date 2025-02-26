<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {return view('home');})->middleware('isAdmin')->name('home');
    Route::get('/home', function () {return view('home');})->name('home');
    Route::get('/blogs', function () {return view('blogs');})->name('blogs');
    Route::get('/hébergements', [PropertyController::class, 'index'])->name('hébergements.index');
    Route::get('/Hébergements/{Hébergement}', [PropertyController::class, 'show'])->name('Hébergements.show');
    Route::get('/Hébergements/create', [PropertyController::class, 'create'])->name('Hébergements.create');
    Route::post('/Hébergements/store', [PropertyController::class, 'store'])->name('Hébergements.store');
});
