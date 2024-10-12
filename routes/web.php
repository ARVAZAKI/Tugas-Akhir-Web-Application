<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');
Route::view('/test', 'layouts.dashboard-layout');

Volt::route('guru', 'pages.guru.dashboard-guru')->name('guru');
Volt::route('guru/absen', 'pages.guru.absen-guru')->name('guru.absen');
Volt::route('guru/izin', 'pages.guru.izin-guru')->name('guru.izin');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/coba', 'tes')
    ->name('tes');

require __DIR__ . '/auth.php';
