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
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::table('users')
            ->where('status', '=', 'P')
            ->where(function($q)use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('NIK', 'like', '%' . $request->search . '%');
            })->get();

            // $user = Users::select('id')->where('nama', 'like', '%' . $request->search . '%')->where('status', '=', 'P')->get();
            $data = Pesanan::where('id_pasien', '=',$user[0]->id)->get();
            for($j=1; $j<count($user); $j++){
                $x = Pesanan::where('id_pasien', '=',$user[$j]->id)->get();
                $data->push($x[0]);
            }
            // $output = '<h3>'.$data.'<h3/>';
            $output = '';
            $i = 1;
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                        <tr class="text-center montserrat-bold">                        
                            <td class="color-inti" scope="row">'.$i.'</td>
                            <td class="color-inti"><a href="/detailPasien/'.$item->id_pasien.'">'.$item->user_pasien->NIK.'</a></td>
                            <td class="color-inti nama_panjang"><a href="/detailPasien/'.$item->id_pasien.'">'.$item->user_pasien->nama.'</a></td>
                            <td class="color-abu-tuo">'.$item->created_at.'</td>
                            <td class="color-inti"><a href="/detailLayanan/'.$item->id_layanan.'">'.$item->layanan->nama_layanan.'</a></td>
                            <td><div class="d-inline-flex status_chip '.($item->status_layanan->status).' ">'.$item->status_layanan->status.'</div></td>
                            <td><a href="/detailPesanan/'.$item->id.'" class="btn btn-success" id="pesan-btn">Detail</a></td>        
                        </tr>';
                
                    $i++;
                }
            } else {
                
                $output .= '
                <tr class="text-center montserrat-bold">                        
                    <td class="color-inti" scope="row"></td>
                    <td class="color-inti"></td>
                    <td class="color-inti nama_panjang"></td>
                    <td class="color-abu-tuo"></td>
                    <td class="color-inti"></td>
                    <td></td>
                    <td></td>        
                </tr>
                '
                ;
            }

            return $output;
        }
    }
    
    public function detail_admin(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        return view("admin.pesanan.detailPesanan",compact('pesanan'));
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
        
        
        $pesanan->id_pasien = Auth::user()->id;
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
            'foto' => 'file|image',
            'status_jasa' =>'required',
            'NIK_jasa' =>'required'
        ],
        [
            'status_jasa.required' => 'silahkan pilih jasa !',
            'NIK_jasa.required' => 'silahkan isi NIK jasa !'
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
    public function batalPesanan(Request $request, $id, Pesanan $pesanan)
    {
        // dd($request->all());

        $pesanan = Pesanan::find($id);   
        $pesanan->id_status_layanan = "B";
        $pesanan->save();

        // dd($hargajasalayanan);
        return redirect()->route("pasien.profile");
    }
}
