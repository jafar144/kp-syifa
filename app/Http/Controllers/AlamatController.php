<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;

class AlamatController extends Controller
{
    public function main(){
        $hargalayanan = Alamat::all();
        return view("hargalayanan.main",compact('hargalayanan'));
    }
}
