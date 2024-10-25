<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function laporan(){
        return view('laporan');
    }

    public function createLaporan(Request $request){
        $request->validate([
            'keterangan' => 'required|string',
            'foto' => 'image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/laporan', $fileName, 'public');
        }

        $laporan = Laporan::create([
            'user_id' => Auth::user()->id,
            'keterangan' => $request->keterangan,
            'foto' => $fileName,
        ]);

        return redirect()->back()->with('success','berhasil membuat laporan');
    }
}
