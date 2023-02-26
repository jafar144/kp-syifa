<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Users;
use App\Models\StatusUser;
use App\Models\Pesanan;
use App\Models\StatusLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function daftarStaff(){
        $staff = Users::where('status', '!=', 'P')->get();
        $statusStaff = StatusUser::where('id','!=','P')->get();
        $reqselected = ['all'];
        return view("admin.staff.daftarStaff",compact('staff','statusStaff','reqselected'));
    }
    public function daftarStaffFilter(Request $request){
        if($request->status_staff == "all"){
            $staff = Users::all();
        }else{
            $staff = Users::where('status', '=', $request->status_staff)->get();
        }
        $statusStaff = StatusUser::where('id','!=','P')->get();
        $reqselected = [$request->status_staff];
        return view("admin.staff.daftarStaff",compact('staff','statusStaff','reqselected'));
    }
    public function daftarPasien(){
        $pasien = Users::where('status', '=', 'P')->get();
        return view("admin.pasien.daftarPasien",compact('pasien'));
    }
    public function daftarLayananFilter(Request $request){
        
        if($request->show == "all"){
            $layanan = Layanan::all();
        }else{
            $layanan = Layanan::all();
            $layanan = Layanan::where('show', '=', $request->show)->get();
        }
        $reqselected = [$request->show];
        return view("admin.layanan.daftarLayanan",compact('layanan','reqselected'));
    }
    public function daftarLayanan(){
        $layanan = Layanan::all();
        $reqselected = ['all'];
        return view("admin.layanan.daftarLayanan",compact('layanan','reqselected'));
    }
    public function daftarStatusStaff(){
        $statusStaff = StatusUser::where('status', '!=', 'P')->get();
        return view("admin.statusUser.daftarStatusStaff",compact('statusStaff'));
    }
    public function daftarPesanan(){
        $pesanan = Pesanan::where('id_status_layanan', '=', 'M')->paginate(10);
        // dump($pesanan);
        $statuspesanan = StatusLayanan::all();
        $layanans = Layanan::all();
        $reqselected = ['M','all','all'];
        return view("admin.pesanan.daftarPesanan",compact('pesanan','statuspesanan','layanans','reqselected'));
    }
}
