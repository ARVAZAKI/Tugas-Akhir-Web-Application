<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\admin\MapelController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->middleware('guest');
Route::view('/test', 'layouts.dashboard-layout');

Route::get('/guru', function(){
 return view('guru.dashboard-guru');
})->name('guru');
Route::get('/absen-guru', function(){
 return view('guru.absen-guru');
})->name('absen-guru');
Route::get('/izin-guru', function(){
 return view('guru.izin-guru');
})->name('izin-guru');


Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::view('dashboard-admin', 'livewire.admin.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.admin');

    Route::get('/create-account', [AccountController::class, "index"])->name('create-account');
    Route::post('/create-account', [AccountController::class, "store"])->name('store-account');
    Route::delete('/delete-account/{id}', [AccountController::class, "delete"])->name('delete-account');

    Route::get('/create-kelas', [ClassController::class, "index"])->name('create-kelas');
    Route::post('/create-kelas', [ClassController::class, "store"])->name('store-kelas');
    Route::delete('/delete-kelas/{id}', [ClassController::class, "delete"])->name('delete-kelas');

    Route::get('/create-mapel', [MapelController::class, "index"])->name('create-mapel');
    Route::post('/create-mapel', [MapelController::class, "store"])->name('store-mapel');
    Route::delete('/delete-mapel/{id}', [MapelController::class, "delete"])->name('delete-mapel');
    Route::delete('/delete-mapel-kelas/{id}', [MapelController::class, "deleteKelas"])->name('delete-mapel-kelas');

    Route::post('/create-mapel-kelas', [MapelController::class, "createKM"])->name('create-KM');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
