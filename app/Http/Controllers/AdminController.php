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
        $statusStaff = StatusUser::where('id','!=','P')->get();
        $reqselected = ['all'];
        return view("admin.daftarStaff",compact('staff','statusStaff','reqselected'));
    }
    public function daftarStaffFilter(Request $request){
        if($request->status_staff == "all"){
            $staff = Users::all();
        }else{
            $staff = Users::where('status', '=', $request->status_staff)->get();
        }
        $statusStaff = StatusUser::where('id','!=','P')->get();
        $reqselected = [$request->status_staff];
        return view("admin.daftarStaff",compact('staff','statusStaff','reqselected'));
    }
    public function daftarPasien(){
        $pasien = Users::where('status', '=', 'P')->get();
        return view("admin.daftarPasien",compact('pasien'));
    }
    public function daftarLayananFilter(Request $request){
        
        if($request->show == "all"){
            $layanan = Layanan::all();
        }else{
            $layanan = Layanan::all();
            $layanan = Layanan::where('show', '=', $request->show)->get();
        }
        $reqselected = [$request->show];
        return view("admin.daftarLayanan",compact('layanan','reqselected'));
    }
    public function daftarLayanan(){
        $layanan = Layanan::all();
        $reqselected = ['all'];
        return view("admin.daftarLayanan",compact('layanan','reqselected'));
    }
    public function daftarStatusStaff(){
        $statusStaff = StatusUser::where('status', '!=', 'P')->get();
        return view("admin.daftarStatusStaff",compact('statusStaff'));
    }
}
