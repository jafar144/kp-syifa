<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
class AlamatController extends Controller
{
    public function alamat_pasien(){
        $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();        
        return view("pasien.alamat.main",compact('alamat'));
    }
    public function addView()
    {
        return view("pasien.alamat.add");        
    }
    public function updateView($id)
    {
        $alamat = Alamat::find($id);
        return view("pasien.alamat.update",compact('alamat'));        
    }
}
