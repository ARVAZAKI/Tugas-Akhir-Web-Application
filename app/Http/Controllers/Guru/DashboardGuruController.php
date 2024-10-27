<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    /**
     * Menampilkan halaman dashboard guru
     */
    public function home()
    {
        $guru = [
            [
                'mata_kuliah' => 'Praktek Pemograman',
                'kelas' => '12 RPL 1',
            ],
            [
                'mata_kuliah' => 'Praktek Pemograman',
                'kelas' => '12 RPL 1',
            ],
            [
                'mata_kuliah' => 'Basis Data II',
                'kelas' => '14 RPL 1',
            ],
        ];
        return view('livewire.pages.guru.dashboard-guru', compact('guru'));
    }
}
