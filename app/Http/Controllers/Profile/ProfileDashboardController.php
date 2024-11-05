<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileDashboardController extends Controller
{
    //Menampilkan halaman dashboard profile
    public function profile()
    {
        return view('livewire.profile.profile-dashboard');
    }
}
