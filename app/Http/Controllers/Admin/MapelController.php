<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\GuruMapel;
use App\Models\KelasMapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    public function index(){
        $mapel = MataPelajaran::with('guru','kelas')->get();
        $guru = User::where('role','teacher')->get();
        return view('admin.create-mapel', compact('mapel','guru'));
    }
    
    public function store(Request $request){
        $request->validate([
            'nama_mapel' => 'required'
        ],
        [
            'nama_mapel.required' => 'Nama mapel wajib diisi.',
        ]);

        $mapel = MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel
        ]);

        $kelasArray = Kelas::all();
        $guruArray = User::where('role','teacher')->get();

        // Buat relasi antara kelas dan mata pelajaran
        foreach ($kelasArray as $kelas) {
                KelasMapel::create([
                    'kelas_id' => $kelas->id,
                    'mapel_id' => $mapel->id
                ]);
        }
        foreach ($guruArray as $g) {
                GuruMapel::create([
                    'user_id' => $g->id,
                    'mapel_id' => $mapel->id
                ]);
        }
        return redirect()->back()->with('message', "berhasil menambah mata pelajaran");
    }

    public function delete($id){
        $mapel  = MataPelajaran::find($id);
        $mapel->delete();
        return redirect()->back()->with('message', 'berhasil menghapus mapel');
    }

    public function deleteKelas($id){
        $mapelKelas = KelasMapel::where('kelas_id', $id)->delete();
        return redirect()->back()->with('message', 'berhasil menghapus kelas');
    }

    public function createKM(Request $request){
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'user_id' => 'required|exists:users,id'
        ]);
    
        try {
            DB::transaction(function() use ($validated) {
                GuruMapel::create([
                    'mapel_id' => $validated['mapel_id'],
                    'user_id' => $validated['user_id']
                ]);
            });
            
            return redirect()->back()->with('message', 'Berhasil menghubungkan kelas mapel');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}
