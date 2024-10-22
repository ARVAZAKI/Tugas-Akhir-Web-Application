<?php

namespace App\Http\Controllers;

use App\Models\AbsenSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function handleAbsenSekolah(Request $request)
{
    // Validasi request
    $validator = Validator::make($request->all(), [
        'lokasi' => 'required'
    ], [
        'lokasi.required' => 'Harap nyalakan lokasi Anda saat ini.'
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Buat absensi jika validasi berhasil
    $absenSekolah = AbsenSekolah::create([
        'user_id' => Auth::user()->id,
        'status' => 'hadir',
        'lokasi' => $request->lokasi
    ]);

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Berhasil melakukan absensi sekolah.');
}

}
