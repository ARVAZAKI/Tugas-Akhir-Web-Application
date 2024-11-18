<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenSekolah;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function izin(){
        $izin = AbsenSekolah::with('user')->where('status','izin')->get();
        return view('admin.izin',compact('izin'));
    }
}
