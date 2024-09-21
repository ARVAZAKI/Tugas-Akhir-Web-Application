<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/test', 'layouts.dashboard-layout');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::view('dashboard-admin', 'livewire.admin.dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard.admin');

    Route::view('create-account', 'livewire.admin.create-account')
        ->middleware(['auth', 'verified'])
        ->name('create-account');

    Route::view('create-kelas', 'livewire.admin.create-kelas')
        ->middleware(['auth', 'verified'])
        ->name('create-kelas');

    Route::view('create-mapel', 'livewire.admin.create-mapel')
        ->middleware(['auth', 'verified'])
        ->name('create-mapel');

    Route::view('izin', 'livewire.admin.izin')
        ->middleware(['auth', 'verified'])
        ->name('izin');

});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
