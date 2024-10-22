<?php

namespace App\Http\Controllers;

use App\Models\AbsenSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function absen()
    {
        $absenToday = AbsenSekolah::where('user_id', Auth::user()->id)
            ->whereDate('created_at', today())
            ->get();
        
        $statusAbsen = $absenToday->count() > 0;
        
        return view('absen-sekolah', compact('statusAbsen'));
    }
    public function handleAbsenSekolah(Request $request){
        $absenSekolah = AbsenSekolah::create([
            'user_id' => Auth::user()->id,
            'status' => 'hadir',
            'lokasi' => $request->lokasi
        ]);
        return redirect()->back();
    }
}
