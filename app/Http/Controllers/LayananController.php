<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\StatusUser;
use Illuminate\Support\Facades\DB;
use App\Models\HargaLayanan;

class LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail(Request $request, $id)
    {
        $this->authorize('detailLayanan', Layanan::class);
        $layanan = Layanan::find($id);
        $harga_layanan = HargaLayanan::where('id_layanan', '=', $id)->get();
        return view("admin.layanan.detailLayanan",compact('layanan', 'harga_layanan'));
    }

    public function addView()
    {
        $this->authorize('tambahLayanan', Layanan::class);
        $statusjasa = StatusUser::where('is_active', '=', 'Y')->get();
        return view("admin.layanan.add",compact('statusjasa'));        
    }

    public function add(Request $request)
    {
        $this->authorize('tambahLayanan', Layanan::class);
        $validation = $request->validate([
            'nama_layanan' => 'required|unique:layanan,nama_layanan'
        ],
        [
            'nama_layanan.unique'=>'Nama layanan sudah ada di daftar! silahkan masukkan layanan yang lain!',
            'nama_layanan.required' => 'Nama layanan harus diisi !'
        ]
        );

        $layanan = new Layanan();
        $layanan->nama_layanan = $validation["nama_layanan"];
        $layanan->deskripsi = $request->deskripsi;
        $layanan->use_foto = $request->has('use_foto') ? "Y" : "T";
        $layanan->show = $request->has('show') ? "Y" : "T";
        
        if($request->jasa){
                $harga = $request->harga;
                $n= count($harga);
                for($i=0; $i < $n; $i++){
                    if($harga[$i] == null)
                    {
                        unset($harga[$i]);
                    }
                }
                foreach($harga as $elemen){
                    if ($elemen < 0) {
                        $error = "harga harus positif";
                        return redirect()->back()->withErrors($error);
                    }
                }
                $harga = array_values($harga);
                if (count($harga) != count($request->jasa)) {
                    $error = "kolom harga jangan dibiarkan kosong";
                    return redirect()->back()->withErrors($error);
                }else{
                $layanan->save();
                for($i=0; $i < count($request->jasa); $i++){
                    $hargalayanan = new HargaLayanan();
                    $hargalayanan->id_layanan = $layanan->id;
                    $hargalayanan->id_status_jasa = $request->jasa[$i];
                    $hargalayanan->harga = $harga[$i];
                    $hargalayanan->save();
                }
            }
            }        
    
            $request->session()->flash("info","Layanan $request->nama_layanan berhasil ditambah!");
        
        return redirect()->route("layanan.main");
        
    }
    public function updateView(Request $request, $id)
    {
        $this->authorize('updateLayanan', Layanan::class);
        $allJasa = StatusUser::where('is_active', '=', 'Y')->get();
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        $layanan = Layanan::find($id);
        
        return view("admin.layanan.update",compact('layanan','jasa','allJasa'));
    }
    public function update(Request $request, $id, Layanan $layanan)
    {
        $this->authorize('updateLayanan', Layanan::class);
        $validation = $request->validate([
            'nama_layanan' => 'required|unique:layanan,nama_layanan,'.$id,
            'harga'=>'required|array'
        ],        
        [
            'nama_layanan.unique'=>'Nama layanan sudah ada di database! silahkan masukkan layanan yang lain!',
            'nama_layanan.required' => 'Nama layanan harus diisi !'
        ]);
        $layanan = Layanan::find($id);
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->use_foto = $request->has('use_foto') ? "Y" : "T";
        $layanan->show = $request->has('show') ? "Y" : "T";
        $layanan->save();

        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        HargaLayanan::destroy($jasa);

        if($request->jasa){
            
            $harga = $request->harga;
            $n = count($harga);
            for($i=0; $i <$n ; $i++){
                if($harga[$i] == null)
                {
                    unset($harga[$i]);
                }
            }
            foreach($harga as $elemen){
                if ($elemen < 0) {
                    $error = "harga harus positif";
                    return redirect()->back()->withErrors($error);
                }
            }
            $harga = array_values($harga); 
            if (count($harga) != count($request->jasa)) {
                $error = "kolom harga jangan dibiarkan kosong";
                return redirect()->back()->withErrors($error);
            }else{
                for($i=0; $i < count($request->jasa); $i++){
                    $hargalayanan = new HargaLayanan();
                    $hargalayanan->id_layanan = $layanan->id;
                    $hargalayanan->id_status_jasa = $request->jasa[$i];
                    $hargalayanan->harga = $harga[$i];
                    $hargalayanan->save();
                }
            }
        }

        $request->session()->flash("info","Layanan $request->nama_layanan berhasil diupdate!");
        return redirect()->route("layanan.detailLayanan",[$id]);
    }
}