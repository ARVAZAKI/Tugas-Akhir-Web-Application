<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
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
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('message', "berhasil menambah akun");
    }

    public function delete($id){
        $user  = User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'berhasil menghapus akun');
    }
}
