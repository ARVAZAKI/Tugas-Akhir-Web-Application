<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    $validator = Validator::make($request->all(), [
        'lokasi' => 'required'
    ], [
        'lokasi.required' => 'Harap nyalakan lokasi Anda saat ini.'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $lokasiSekolah = [
        'latitude' => -7.275604, 
        'longitude' => 112.793752 
    ];

    list($latUser, $lngUser) = explode(',', $request->lokasi);

    $jarak = $this->calculateDistance($latUser, $lngUser, $lokasiSekolah['latitude'], $lokasiSekolah['longitude']);

    if ($jarak > 1) {  
        return redirect()->back()->with('error', 'Anda tidak berada dalam radius 1km dari lokasi sekolah untuk melakukan absensi.');
    }

    $absenSekolah = AbsenSekolah::create([
        'user_id' => Auth::user()->id,
        'status' => 'hadir',
        'lokasi' => $request->lokasi
    ]);

    return redirect()->back()->with('success', 'Berhasil melakukan absensi sekolah.');
}

private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; 

    $latDiff = deg2rad($lat2 - $lat1);
    $lonDiff = deg2rad($lon2 - $lon1);

    $a = sin($latDiff / 2) * sin($latDiff / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($lonDiff / 2) * sin($lonDiff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c; 
    return $distance;
}

public function rekapAbsen()
{
    $user = User::with('kelas')->get();

    // Mendapatkan filter tanggal dari request
    $fromDate = request('from_date');
    $toDate = request('to_date');

    // Query absensi dengan filter tanggal
    $absen = AbsenSekolah::with('user')
        ->when($fromDate, function ($query, $fromDate) {
            return $query->whereDate('created_at', '>=', $fromDate);
        })
        ->when($toDate, function ($query, $toDate) {
            return $query->whereDate('created_at', '<=', $toDate);
        })
        ->get();

    return view('admin.daftar-hadir', compact('absen','user'));
}
}
