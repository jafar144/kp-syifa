<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function main(){
        $layanan = Layanan::all();
        return view("layanan.main",compact('layanan'));
    }
    public function detail(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        return view("layanan.detail",compact('layanan'));
    }
    public function addView()
    {
        return view("layanan.add");        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'nama_layanan' => 'required'
        ]);
        $layanan = new Layanan();
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->save();

        $request->session()->flash("info","Data Layanan $request->nama_layanan berhasil disimpan!");
        return redirect()->route("layanan.addView");
    }
    public function updateView(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        return view("layanan.update",compact('layanan'));
    }
    public function update(Request $request, $id, Layanan $layanan)
    {
        $validation = $request->validate([
            'nama_layanan' => 'required'
        ]);
        $layanan = Layanan::find($id);
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->save();
        
        $request->session()->flash("info","Data Layanan $request->nama_layanan berhasil diupdate!");
        return redirect()->route("layanan.updateView",[$id]);
    }
    public function delete(Request $request, $id, Layanan $layanan)
    {
        $layanan = Layanan::find($id);
        if($layanan->id){
            $layanan->delete();
        }
        $request->session()->flash("info","Data Layanan $request->nama_layanan berhasil dihapus!");
        return redirect()->route("layanan.main");
    }
}
