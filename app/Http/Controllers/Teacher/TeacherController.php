<?php

namespace App\Http\Controllers\Teacher;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\GuruMapel;
use App\Models\AbsenMapel;
use App\Models\KelasMapel;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        // Mendapatkan data guru berdasarkan user yang sedang login
        $guru = Auth::user();
    
        // Mengambil data GuruMapel berdasarkan user_id guru saat ini
        $guruMapel = GuruMapel::where('user_id', $guru->id)->get();
    
        // Mengambil data mata pelajaran berdasarkan GuruMapel
        $mapel = MataPelajaran::whereIn('id', $guruMapel->pluck('mapel_id'))->get();
    
        // Mengirimkan data ke view
        return view('guru.dashboard-guru', [
            'mapel' => $mapel
        ]);
    }
    public function listKelasAbsen($mapelId){
        $mapel = MataPelajaran::with('kelas')->where('id',$mapelId)->first();
        return view('guru.list-kelas-mapel', compact('mapel'));
    }
    public function absenMapel($mapelId, $kelasId)
{
    $mapel = MataPelajaran::with('kelas')->where('id', $mapelId)->first();
    $kelas = Kelas::with('mapel', 'users')->where('id', $kelasId)->first();
    $statusAbsen = KelasMapel::where('mapel_id', $mapelId)
        ->where('kelas_id', $kelasId)
        ->first();
    $jumlahAbsen = AbsenMapel::where('mapel_id', $mapelId)
        ->where('kelas_id', $kelasId)
        ->where('status', 'hadir')
        ->whereDate('created_at', Carbon::today())
        ->count();
    
    // Fetch students who are present today
    $muridHadir = AbsenMapel::with('user')
        ->where('mapel_id', $mapelId)
        ->where('kelas_id', $kelasId)
        ->whereDate('created_at', Carbon::today())
        ->where('status', 'hadir')
        ->get();

    return view('guru.absen-mapel', compact('mapel', 'kelas', 'statusAbsen', 'jumlahAbsen', 'muridHadir'));
}

    
    public function openAbsen($mapelId, $kelasId)
    {
        $statusAbsen = KelasMapel::where('mapel_id', $mapelId)
                                  ->where('kelas_id', $kelasId)
                                  ->first();
    
        if ($statusAbsen->status_absen !== 'open') {
            $statusAbsen->status_absen = 'open';
            $statusAbsen->save();
        }
    
        return redirect()->back()->with('message', 'Absensi telah dibuka.');
    }
    public function closeAbsen($mapelId, $kelasId)
    {
        $statusAbsen = KelasMapel::where('mapel_id', $mapelId)
                                  ->where('kelas_id', $kelasId)
                                  ->first();
    
        if ($statusAbsen->status_absen !== 'closed') {
            $statusAbsen->status_absen = 'closed';
            $statusAbsen->save();
        }
    
        return redirect()->back()->with('message', 'Absensi telah ditutup.');
    }
    
    
}
