<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function home(){
        $layanan = Layanan::all();
        return view("pasien.homePasien" ,compact('layanan'));
    }
}
