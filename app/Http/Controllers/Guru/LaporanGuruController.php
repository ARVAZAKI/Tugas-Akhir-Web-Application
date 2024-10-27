<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanGuruController extends Controller
{
    /**
     * Form laporan untuk guru
     */
    public function laporan()
    {
        return view('livewire.pages.guru.laporan-guru');
    }
}
