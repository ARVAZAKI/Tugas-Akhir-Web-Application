<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\GuruMapel;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        $users = User::whereNot('role', 'student')->get();
        return view('admin.create-account', compact('users'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
            'confirm_password' => 'required|same:password'
        ],
    [
        'nama.required' => 'nama harus diisi',
        'email.required' => 'email harus diisi',
        'email.unique' => 'email sudah ada, silahkan pilih email yang lain',
        'email.email' => 'email harus memiliki format email',
        'role.required' => 'role harus diisi',
        'password.required' => 'password harus diisi',
        'password.min' => 'password harus memiliki minimal 8 karakter',
        'confirm_password.required' => 'konfirmasi password harus diisi',
        'confirm_password.same' => 'konfirmasi password tidak sama dengan password'
    ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        if ($request->role === 'teacher') {
            // Ambil semua mata pelajaran
            $mapelIds = MataPelajaran::pluck('id')->toArray();
    
            // Buat relasi antara guru dan mata pelajaran
            foreach ($mapelIds as $mapelId) {
                GuruMapel::create([
                    'user_id' => $user->id,
                    'mapel_id' => $mapelId
                ]);
            }
        }

        return redirect()->back()->with('message', "berhasil menambah akun");
    }

    public function delete($id){
        $user  = User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'berhasil menghapus akun');
    }
}
