<?php

namespace App\Http\Controllers\Teacher;

use App\Models\AbsenSekolah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
        return view('guru.dashboard-guru');
    }
}
