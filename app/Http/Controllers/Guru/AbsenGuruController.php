<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsenGuruController extends Controller
{
    /**
     * Buka absensi untuk guru
     */
    public function absen()
    {
        return view('livewire.pages.guru.absen-guru');
    }
}
