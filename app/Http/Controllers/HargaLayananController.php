<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HargaLayanan;
use App\Models\Layanan;
use App\Models\StatusUser;

class HargaLayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function main(){
        $hargalayanan = HargaLayanan::all();
        return view("hargalayanan.main",compact('hargalayanan'));
    }
    public function detail(Request $request, $id)
    {
        $hargalayanan = HargaLayanan::find($id);
        return view("hargalayanan.detail",compact('hargalayanan'));
    }
    public function addView()
    {
        $layanans = Layanan::all();
        $jasa = StatusUser::all();
        return view("hargalayanan.add",compact('layanans','jasa'));        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'harga' => 'required|integer|min:0',
            'id_layanan' =>'required',
            'id_status_jasa' =>'required'
        ],
        [
            'harga.min' => 'harga minimal 0 rupiah !',
            'harga.integer' => 'mohon input berupa angka !',
            'harga.required' => 'harga harus diisi !',
            'id_layanan.required' => 'layanan harus diisi !',
            'id_status_jasa.required' => 'jasa harus diisi !'
        ]);
        $hargalayanan = new HargaLayanan();
        $hargalayanan->id_layanan = $request->id_layanan;
        $hargalayanan->id_status_jasa = $request->id_status_jasa;
        $hargalayanan->harga = $request->harga;
        $hargalayanan->save();

        $request->session()->flash("info","Data Harga Layanan $request->id berhasil disimpan!");
        return redirect()->route("hargalayanan.addView");
    }
    public function updateView(Request $request, $id)
    {
        $layanans = Layanan::all();
        $jasa = StatusUser::all();
        $hargalayanan = HargaLayanan::find($id);
        return view("hargalayanan.update",compact('hargalayanan','layanans','jasa'));
    }
    public function update(Request $request, $id, HargaLayanan $hargalayanan)
    {
        $validation = $request->validate([
            'harga' => 'required|integer|min:0',
            'id_layanan' =>'required',
            'id_status_jasa' =>'required'
        ],
        [
            'harga.min' => 'harga minimal 0 rupiah !',
            'harga.integer' => 'mohon input berupa angka !',
            'harga.required' => 'harga harus diisi !',
            'id_layanan.required' => 'layanan harus diisi !',
            'id_status_jasa.required' => 'jasa harus diisi !'
        ]);
        $hargalayanan = HargaLayanan::find($id);
        $hargalayanan->id_layanan = $request->id_layanan;
        $hargalayanan->id_status_jasa = $request->id_status_jasa;
        $hargalayanan->harga = $request->harga;
        $hargalayanan->save();
        
        $request->session()->flash("info","Data Harga Layanan $request->id berhasil diupdate!");
        return redirect()->route("hargalayanan.updateView",[$id]);
    }
    public function delete(Request $request, $id, HargaLayanan $hargalayanan)
    {
        $hargalayanan = HargaLayanan::find($id);
        if($hargalayanan->id){
            $hargalayanan->delete();
        }
        $request->session()->flash("info","Data Harga Layanan $request->id berhasil dihapus!");
        return redirect()->route("hargalayanan.main");
    }
}
