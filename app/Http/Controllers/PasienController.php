<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function home(){
        $layanan = Layanan::all();
        return view("pasien.homePasien" ,compact('layanan'));
    }
    public function search(Request $request){
        $search = $request->search;
        $layanan = Layanan::where('nama_layanan', 'like',"%".$search."%")->get();
        return view('pasien.homePasien',compact('layanan'));
    }
}
