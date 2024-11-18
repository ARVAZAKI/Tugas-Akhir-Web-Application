<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\GuruMapel;
use App\Models\KelasMapel;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat data kelas
        $kelasData = [
            ['nama_kelas' => '12 RPL 1', 'kode_kelas' => '2d2'],
            ['nama_kelas' => '12 RPL 2', 'kode_kelas' => 'Asgfv'],
            ['nama_kelas' => '12 DKV 2', 'kode_kelas' => 'BBWD'],
            ['nama_kelas' => '12 AKL 2', 'kode_kelas' => 'Ghsu'],
        ];

        $kelasArray = [];
        foreach ($kelasData as $data) {
            $kelasArray[] = Kelas::create($data);
        }

        // Membuat data mata pelajaran
        $mapel = [
            'MATEMATIKA',
            'BAHASA INGGRIS',
            'SENI BUDAYA',
            'BAHASA INDONESIA',
            'KOMPUTER'
        ];

        foreach ($mapel as $m) {
            MataPelajaran::create([
                'nama_mapel' => $m
            ]);
        }

        // Membuat data guru
        $guru = User::create([
            'name' => 'arva teacher',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
        ]);

        // Membuat relasi antara guru dan mata pelajaran
        $mapelIds = MataPelajaran::pluck('id')->toArray();
        foreach ($mapelIds as $id) {
            GuruMapel::create([
                'user_id' => $guru->id,
                'mapel_id' => $id
            ]);
        }

        // Membuat relasi antara kelas dan mata pelajaran
        foreach ($kelasArray as $kelas) {
            foreach ($mapelIds as $id) {
                KelasMapel::create([
                    'kelas_id' => $kelas->id,
                    'mapel_id' => $id
                ]);
            }
        }
    }
}
