<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Guru\AbsenGuruController;
use App\Http\Controllers\Guru\DashboardGuruController;
use App\Http\Controllers\Guru\IzinGuruController;
use App\Http\Controllers\Guru\LaporanGuruController;
use App\Http\Controllers\Guru\PenilaianGuruController;
use App\Http\Controllers\Guru\PresensiSekolahGuruController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome')->middleware('guest');
Route::view('/test', 'layouts.dashboard-layout');



Route::prefix('guru')->middleware(['auth'])->group(function () {
    Route::get('', [DashboardGuruController::class, 'home'])->name('guru');
    Route::get('absen', [AbsenGuruController::class, 'absen'])->name('guru.absen');
    Route::get('izin', [IzinGuruController::class, 'izin'])->name('guru.izin');
    Route::get('presensi', [PresensiSekolahGuruController::class, 'presensi'])->name('guru.presensi');
    Route::get('laporan', [LaporanGuruController::class, 'laporan'])->name('guru.laporan');
    Route::get('penilaian', [PenilaianGuruController::class, 'penilaian'])->name('guru.penilaian');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::view('dashboard-admin', 'livewire.admin.dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard.admin');

    Route::view('create-mapel', 'livewire.admin.create-mapel')
        ->middleware(['auth', 'verified'])
        ->name('create-mapel');

    Route::view('izin', 'livewire.admin.izin')
        ->middleware(['auth', 'verified'])
        ->name('izin');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/create-account', [AccountController::class, "index"])->name('create-account');
    Route::post('/create-account', [AccountController::class, "store"])->name('store-account');
    Route::delete('/delete/{id}', [AccountController::class, "delete"])->name('delete-account');
    Route::get('/create-kelas', [ClassController::class, "index"])->name('create-kelas');
    Route::post('/create-kelas', [ClassController::class, "store"])->name('store-kelas');
    Route::delete('/delete/{id}', [ClassController::class, "delete"])->name('delete-kelas');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
