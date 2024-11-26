<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\IzinController as AdminIzinController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\admin\MapelController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->middleware('guest');
Route::view('/test', 'layouts.dashboard-layout');

Route::post('/handle-absen-sekolah', [AbsenController::class, "handleAbsenSekolah"])->name('handle-absen-sekolah')->middleware('auth');;
Route::get('/absen-sekolah', [AbsenController::class, "absen"])->name('absen-sekolah')->middleware('auth');
Route::get('/izin', [IzinController::class, "izin"])->name('izin')->middleware('auth');
Route::post('/izin', [IzinController::class, "postIzin"])->name('izinPost')->middleware('auth');
Route::get('/laporan', [LaporanController::class, "laporan"])->name('laporan')->middleware('auth');
Route::post('/laporan', [LaporanController::class, "createLaporan"])->name('create-laporan')->middleware('auth');
Route::get('/kunjungan', [KunjunganController::class, "kunjungan"])->name('kunjungan');
Route::post('/kunjungan', [KunjunganController::class, "handleKunjungan"])->name('handle-kunjungan');

Route::prefix('guru')->middleware('auth')->group(function(){
    Route::get('/', [TeacherController::class, "index"])->name('dashboard.guru');
    Route::get('/absen-mapel/{mapelId}', [TeacherController::class, "listKelasAbsen"])->name('list.kelas.absen');
    Route::get('/absen-mapel/{mapelId}/{kelasId}', [TeacherController::class, "absenMapel"])->name('absen.mapel');
    Route::post('/open-absen-mapel/{mapelId}/{kelasId}', [TeacherController::class, "openAbsen"])->name('absen.open');
    Route::post('/closed-absen-mapel/{mapelId}/{kelasId}', [TeacherController::class, "closeAbsen"])->name('absen.close');
    Route::get('/rekap-absensi/{mapelId}/{kelasId}', [TeacherController::class, "rekapAbsen"])->name('rekap-absen-siswa');
});
Route::prefix('student')->middleware('auth')->group(function(){
    Route::get('/list-mapel', [StudentController::class, "listMapel"])->name('list.mapel');
    Route::get('/list-mapel/{mapelId}', [StudentController::class, "absenMapel"])->name('absen.mapel.student');
    Route::post('/submit-absen/{mapelId}', [StudentController::class, "submitAbsen"])->name('submit.absen');
});

Route::prefix('admin')->middleware(['auth'])->group(function(){

    Route::get('/kunjungan', [KunjunganController::class, "rekapKunjungan"])->name('admin.kunjungan');
    Route::get('/laporan', [AdminLaporanController::class, "laporan"])->name('admin.laporan');
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

    Route::get('/izin', [AdminIzinController::class, "izin"])->name('izin.admin')->middleware('auth');
    Route::get('/rekap-absen-sekolah', [AbsenController::class, "rekapAbsen"])->name('rekap-absen-sekolah')->middleware('auth');

});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
