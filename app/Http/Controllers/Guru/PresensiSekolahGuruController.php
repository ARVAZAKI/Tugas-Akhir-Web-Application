<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresensiSekolahGuruController extends Controller
{
    /**
     * Menampilkan halaman presensi guru
     */
    public function presensi()
    {
        return view('livewire.pages.guru.presensi-sekolah-guru');
    }
}
