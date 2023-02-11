<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\StatusUser;
use App\Models\Layanan;
use App\Models\HargaLayanan;
use App\Models\StatusLayanan;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Auth;

class PesananController extends Controller
{
    public function main(){
        $pesanan = Pesanan::all();
        return view("pesanan.main",compact('pesanan'));
    }
    public function detail(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        return view("pesanan.detail",compact('pesanan'));
    }
    public function addView($id)
    {
        
        $jasa = StatusUser::all();
        $layanan = Layanan::find($id);
        return view("pesanan.add",compact('layanan','jasa'));        
    }
    public function add(Request $request,$id)
    {
        $layanan = Layanan::find($id);
        $validation = $request->validate([
            'id_status_jasa' =>'required',
            'alamat' =>'required',
            'foto' => 'file|image',
            'tanggal_perawatan' =>'required',
            'jam_perawatan' =>'required',
        ],
        [
            'id_status_jasa.required' => 'silahkan pilih jasa yang anda inginkan !',
            'alamat.required' => 'silahkan isi alamat anda !',
            'tanggal_perawatan.required' => 'silahkan pilih tanggal untuk perawatan !',
            'jam_perawatan.required' => 'silahkan pilih waktu untuk perawatan !',
        ]);
        $pesanan = new Pesanan();
        if($request->foto)
        {
            $ext = $request->foto->getClientOriginalExtension();
            $nama_file = Auth::user()->NIK.'-'.time().".".$ext;
            $path = $request->foto->storeAs("public", $nama_file);
            $pesanan->foto = $nama_file;
        }
        $hargajasalayanan = HargaLayanan::where('id_layanan', '=', $id)
        ->where('id_status_jasa', '=', $request->id_status_jasa)
        ->get();
        
        
        $pesanan->NIK_pasien = Auth::user()->NIK;
        $pesanan->id_layanan = $layanan->id;
        $pesanan->id_status_jasa = $request->id_status_jasa;
        $pesanan->alamat = $request->alamat;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->keluhan = $request->keluhan;       
        $pesanan->status_pembayaran = "T"; 
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;
        $pesanan->jam_perawatan = $request->jam_perawatan;

        $pesanan->save();
        $jasa = StatusUser::all();

        $request->session()->flash("info","Data Pesanan anda berhasil disimpan!");
        return view("pesanan.add",compact('layanan','jasa'));
    }
    public function updateView(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        $statusJasa = StatusUser::all();
        $layanan = Layanan::all();
        $statusLayanan = StatusLayanan::all();
        
        return view("pesanan.update",compact('pesanan','layanan','statusJasa','nikJasa','statusLayanan'));
    }
    public function updateByAdmin(Request $request, $id, Pesanan $pesanan)
    {
        $validation = $request->validate([
            'foto' => 'file|image'
        ]);
        $hargajasalayanan = HargaLayanan::where('id_layanan', '=', $request->id_layanan)
        ->where('id_status_jasa', '=', $request->id_status_jasa)
        ->get();

        $pesanan = Pesanan::find($id);
        if($request->foto)
        {
            $ext = $request->foto->getClientOriginalExtension();
            $nama_file = Auth::user()->NIK.'-'.time().".".$ext;
            $path = $request->foto->storeAs("public", $nama_file);
            $pesanan->foto = $nama_file;
        }        
        $pesanan->id_layanan = $request->id_layanan;
        $pesanan->id_status_jasa = $request->id_status_jasa;
        $pesanan->NIK_jasa = $request->NIK_jasa;
        $pesanan->alamat = $request->alamat;
        $pesanan->keluhan = $request->keluhan;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->id_status_layanan = $request->id_status_layanan;
        $pesanan->status_pembayaran = $request->status_pembayaran;
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;
        $pesanan->jam_perawatan = $request->jam_perawatan;
        $pesanan->save();

        
        return redirect()->route("pesanan.main");
    }
}
