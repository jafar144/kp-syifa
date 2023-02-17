<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Users;
use App\Models\StatusUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function daftarStaff(){
        $staff = Users::where('status', '!=', 'P')->get();
        return view("admin.daftarStaff",compact('staff'));
    }
    public function daftarPasien(){
        $pasien = Users::where('status', '=', 'P')->get();
        return view("admin.daftarPasien",compact('pasien'));
    }
    public function daftarLayanan(){
        $layanan = Layanan::all();
        return view("admin.daftarLayanan",compact('layanan'));
    }
    public function daftarStatusStaff(){
        $statusStaff = StatusUser::where('status', '!=', 'P')->get();
        return view("admin.daftarStatusStaff",compact('statusStaff'));
    }
}
