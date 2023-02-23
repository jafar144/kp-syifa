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
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function main(){
        $pesanan = Pesanan::all();
        return view("pesanan.main",compact('pesanan'));
    }
    public function adminPesanan(){
        $pesanan = Pesanan::where('id_status_layanan', '=', 'M')
                    ->paginate(10);
        // dump($pesanan);
        $statuspesanan = StatusLayanan::all();
        $layanans = Layanan::all();
        $reqselected = ['M','all','all'];
        return view("admin.pesananAdmin",compact('pesanan','statuspesanan','layanans','reqselected'));
    }
    public function adminPesananFilter(Request $request){
        $pesanan = Pesanan::where('id_status_layanan', '=', 'M')->paginate(10);
        if($request->id_status_layanan == "all" && $request->id_layanan == "all" && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::paginate(10);
        }else if($request->id_status_layanan !== "all" && $request->id_layanan == "all"  && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_status_layanan', '=', $request->id_status_layanan)->paginate(10);
        }else if($request->id_status_layanan == "all" && $request->id_layanan !== "all"  && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)->paginate(10);
        }else if($request->id_status_layanan == "all" && $request->id_layanan == "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)->paginate(10);
        }else if($request->id_status_layanan !== "all" && $request->id_layanan == "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)
            ->where('id_status_layanan', '=', $request->id_status_layanan)->paginate(10);
        }else if($request->id_status_layanan == "all" && $request->id_layanan !== "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('status_pembayaran', '=', $request->status_pembayaran)->paginate(10);
        }else if($request->id_status_layanan !== "all" && $request->id_layanan !== "all" && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('id_status_layanan', '=', $request->id_status_layanan)->paginate(10);
        }else if($request->id_status_layanan !== "all" && $request->id_layanan !== "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('id_status_layanan', '=', $request->id_status_layanan)
            ->where('status_pembayaran', '=', $request->status_pembayaran)->paginate(10);
        }

        // nested if
        // if($request->id_status_layanan == "all"){
        //     if($request->id_layanan == "all"){
        //         if($request->status_pembayaran == "all"){
        //             $pesanan = Pesanan::all();
        //         }else{
        //             $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)->get();
        //         }
        //     }else{
        //         if($request->status_pembayaran == "all"){
        //             $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)->get();
        //         }else{
        //             $pesanan = Pesanan::where('id_status_layanan', '=', $request->id_status_layanan)
        //             ->where('status_pembayaran', '=', $request->status_pembayaran)->get();
        //         }
        //     }
        // }else{
        //     if($request->id_layanan == "all"){
        //         if($request->status_pembayaran == "all"){
        //             $pesanan = Pesanan::where('id_status_layanan', '=', $request->id_status_layanan)->get();
        //         }else{
        //             $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)
        //             ->where('id_status_layanan', '=', $request->id_status_layanan)->get();
        //         }
        //     }else{
        //         if($request->status_pembayaran == "all"){
        //             $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
        //             ->where('id_status_layanan', '=', $request->id_status_layanan)->get();
        //         }else{
        //             $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
        //             ->where('id_status_layanan', '=', $request->id_status_layanan)
        //             ->where('status_pembayaran', '=', $request->status_pembayaran)->get();
        //         }
        //     }
        // }
        
        // dd($pesanan);
        $statuspesanan = StatusLayanan::all();
        $reqselected = [$request->id_status_layanan,$request->id_layanan,$request->status_pembayaran];
        $layanans = Layanan::all();
        
        return view("admin.pesananAdmin",compact('pesanan','statuspesanan','layanans','reqselected'));
    }
    public function detail(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        return view("pesanan.detail",compact('pesanan'));
    }
    public function addView($id)
    {
        // $jasa = StatusUser::all();
        $layanan = Layanan::find($id);
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        // dd($jasa);
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
        $pesanan->id_status_layanan = "M";
        $pesanan->alamat = $request->alamat;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->keluhan = $request->keluhan;       
        $pesanan->status_pembayaran = "T"; 
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;
        $pesanan->jam_perawatan = $request->jam_perawatan;

        $pesanan->save();
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();

        $request->session()->flash("info","Data Pesanan anda berhasil disimpan!");
        return view("pesanan.add",compact('layanan','jasa'));
    }
    public function getStatusJasa($id)
    {
        $status_jasa = HargaLayanan::where('id_layanan',$id)->with('status_user')->get();
        return response()->json($status_jasa);
    }
    public function getNikJasa($id)
    {
        $nik_jasa = Users::where('status',$id)->get();
        return response()->json($nik_jasa);
    }
    public function updateView(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        // $statusJasa = StatusUser::all();
        // $statusJasa = HargaLayanan::all();
        $statusJasa = HargaLayanan::where('id_layanan', '=', $pesanan->id_layanan)->get();
        $layanan = Layanan::all();
        $statusLayanan = StatusLayanan::all();
        $coba = $pesanan->id_layanan;
        // dd($statusJasa[0]->layanan);

        
        return view("pesanan.update",compact('pesanan','layanan','statusJasa','nikJasa','statusLayanan','coba'));
    }
    public function updateByAdmin(Request $request, $id, Pesanan $pesanan)
    {
        // dd($request->all());
        $validation = $request->validate([
            'foto' => 'file|image'
        ]);
        $hargajasalayanan = HargaLayanan::where('id_layanan', '=', $request->layanan)
        ->where('id_status_jasa', '=', $request->status_jasa)
        ->get();

        $pesanan = Pesanan::find($id);
        if($request->foto)
        {
            $ext = $request->foto->getClientOriginalExtension();
            $nama_file = Auth::user()->NIK.'-'.time().".".$ext;
            $path = $request->foto->storeAs("public", $nama_file);
            $pesanan->foto = $nama_file;
        }        
        $pesanan->id_layanan = $request->layanan;
        $pesanan->id_status_jasa = $request->status_jasa;
        $pesanan->NIK_jasa = $request->NIK_jasa;
        $pesanan->alamat = $request->alamat;
        $pesanan->keluhan = $request->keluhan;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->id_status_layanan = $request->id_status_layanan;
        $pesanan->status_pembayaran = $request->status_pembayaran;
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;
        $pesanan->jam_perawatan = $request->jam_perawatan.":00";
        $pesanan->save();

        // dd($hargajasalayanan);
        return redirect()->route("pesanan.main");
    }
}
