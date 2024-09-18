<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/test', 'layouts.dashboard-layout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/coba', 'tes')
    ->name('tes');

require __DIR__ . '/auth.php';
