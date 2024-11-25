<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\AbsenMapel;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function listMapel(){
        $user = Auth::user();
        $kelas = Kelas::with('mapel')->where('id', $user->kelas_id)->get();
        return view('student.list-mapel', compact('kelas'));
    }

    public function absenMapel($mapelId){
        $user = Auth::user();
        $mapel = MataPelajaran::find($mapelId);
        $kelas = Kelas::with('mapel')->where('id', $user->kelas_id)->first();
        $statusAbsen = KelasMapel::where('mapel_id', $mapelId)
        ->where('kelas_id', $user->kelas_id)
        ->first();
        $statusKehadiran = AbsenMapel::where('mapel_id', $mapelId)->where('kelas_id', $user->kelas_id)->where('user_id', $user->id)->whereDate('created_at', Carbon::today())->first();
        $riwayatAbsen = AbsenMapel::where('mapel_id', $mapelId)->where('kelas_id', $user->kelas_id)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('student.absen-mapel', compact('kelas','mapel','statusAbsen','statusKehadiran','riwayatAbsen'));
    }

    public function submitAbsen($mapelId)
    {
        $user = Auth::user();
    
        // Periksa apakah siswa sudah absen hari ini
        $statusKehadiran = AbsenMapel::where('mapel_id', $mapelId)
            ->where('kelas_id', $user->kelas_id)
            ->where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->first();
    
        if ($statusKehadiran) {
            return redirect()->back()->with('message', 'Anda sudah absen hari ini.');
        }
    
        // Jika belum absen, simpan data absensi
        AbsenMapel::create([
            'user_id' => $user->id,
            'mapel_id' => $mapelId,
            'kelas_id' => $user->kelas_id,
            'status' => 'hadir'
        ]);
    
        return redirect()->back()->with('message', 'Berhasil absen');
    }
    
}
