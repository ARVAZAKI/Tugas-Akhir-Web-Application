<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IzinGuruController extends Controller
{
    /**
     * Izin untuk guru
     */
    public function izin()
    {
        return view('livewire.pages.guru.izin-guru');
    }
}
