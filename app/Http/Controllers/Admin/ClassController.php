<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    public function index(){
        $kelas = Kelas::all();
        return view('admin.create-kelas', compact('kelas'));
    }
    
    public function store(Request $request){
        $request->validate([
            'nama_kelas' => 'required'
        ]);

        Kelas::create([
            'kode_kelas' => Str::random(5),
            'nama_kelas' => $request->nama_kelas
        ]);
        return redirect()->back()->with('message', "berhasil menambah kelas");
    }

    public function delete($id){
        $user  = Kelas::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'berhasil menghapus kelas');
    }
}
