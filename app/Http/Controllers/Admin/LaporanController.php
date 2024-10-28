<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function laporan(){
        $laporan = Laporan::with('user')->get();
        return view('admin.laporan', compact('laporan'));
    }
}
