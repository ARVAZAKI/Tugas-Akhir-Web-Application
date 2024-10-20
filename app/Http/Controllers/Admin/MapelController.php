<?php

namespace App\Http\Controllers\admin;

use App\Models\Kelas;
use App\Models\KelasMapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use App\Models\GuruMapel;
use App\Models\User;

class MapelController extends Controller
{
    public function index(){
        $mapel = MataPelajaran::all();
        $kelas = Kelas::all();
        $guru = User::where('role','teacher')->get();
        return view('admin.create-mapel', compact('mapel', 'kelas','guru'));
    }
    
    public function store(Request $request){
        $request->validate([
            'nama_mapel' => 'required'
        ],
        [
            'nama_mapel.required' => 'Nama mapel wajib diisi.',
        ]);

        MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel
        ]);
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
        $km = KelasMapel::create([
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
        ]);
        GuruMapel::create([
            'mapel_id' => $request->mapel_id,
            'user_id' => $request->user_id
        ]);
        return redirect()->back()->with('message', 'berhasil menghubungkan kelas mapel');
    }
}
