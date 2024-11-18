<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends Controller
{
    public function kunjungan()
    {
        return view('kunjungan');
    }
    public function handleKunjungan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'lokasi' => 'required',
        'nama' => 'required',
        'keperluan' => 'required'
    ], [
        'lokasi.required' => 'Harap nyalakan lokasi Anda saat ini.',
        'nama.required' => 'Harap masukkan nama Anda.',
        'keperluan.required' => 'Harap masukkan keperluan Anda.'
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
        return redirect()->back()->with('error', 'Anda tidak berada dalam radius 1 km dari lokasi sekolah untuk melakukan absensi.');
    }

    $kunjungan = Kunjungan::create([
        'nama' => $request->nama,
        'keperluan' => $request->keperluan,
        'lokasi' => $request->lokasi,
        'waktu' => now()
    ]);

    return redirect()->back()->with('success', 'Berhasil melakukan submit kunjungan.');
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
}
