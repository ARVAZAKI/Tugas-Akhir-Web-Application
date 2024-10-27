<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenilaianGuruController extends Controller
{
    /**
     * Penilaian matakuliah guru
     */
    public function penilaian()
    {
        return view('livewire.pages.guru.penilaian-guru');
    }
}
