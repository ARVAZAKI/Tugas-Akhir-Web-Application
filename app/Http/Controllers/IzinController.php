<?php

namespace App\Http\Controllers;

use App\Models\AbsenSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function izin(){
        return view('izin');
    }
    public function postIzin(Request $request)
{
    // Validasi input
    $request->validate([
        'surat_izin' => 'required|file|mimes:pdf,jpg,jpeg,png',
        'keterangan' => 'required|string|max:255',
        'tanggal_izin' => 'required|date',
    ]);

    // Upload file surat izin
    if ($request->hasFile('surat_izin')) {
        $file = $request->file('surat_izin');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/surat_izin', $fileName, 'public');
    } else {
        return redirect()->back()->withErrors(['surat_izin' => 'File surat izin wajib diupload']);
    }

    // Simpan data ke database
    $izin = AbsenSekolah::create([
        'surat_izin' => $filePath, // Simpan path file
        'keterangan' => $request->keterangan,
        'tanggal_izin' => $request->tanggal_izin,
        'status' => 'izin',
        'user_id' => Auth::user()->id,
    ]);

    return redirect()->back()->with('success', 'Izin berhasil diajukan');
}

}
