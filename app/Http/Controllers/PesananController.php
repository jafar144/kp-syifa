<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\StatusUser;
use App\Models\Layanan;
use App\Models\Alamat;
use App\Models\HargaLayanan;
use App\Models\StatusLayanan;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
                            <td class="color-inti vertical_space" scope="row">'.$i.'</td>
                            <td class="color-inti vertical_space"><a href="/detailPasien/'.$item->id_pasien.'" class="remove_underline">'.$item->user_pasien->NIK.'</a></td>
                            <td class="color-inti nama_panjang vertical_space"><a href="/detailPasien/'.$item->id_pasien.'" class="remove_underline">'.$item->user_pasien->nama.'</a></td>
                            <td class="color-abu-tuo vertical_space">'.$item->getTanggalWithJam($item->created_at).'</td>
                            <td class="color-inti vertical_space"><a href="/detailLayanan/'.$item->id_layanan.'" class="remove_underline">'.$item->layanan->nama_layanan.'</a></td>
                            <td>
                                <div class="d-inline-flex status_chip vertical_space '.($item->status_layanan->status).' ">'.$item->status_layanan->status.'</div>
                            </td>
                            <td><a href="/detailPesanan/'.$item->id.'" class="btn btn-success vertical_space" id="pesan-btn">Detail</a></td>        
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
    
    public function detail_admin($id)
    {
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        return view("admin.pesanan.detailPesanan",compact('pesanan', 'nikJasa'));
    }

    public function detail_pasien($id)
    {
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        return view("pasien.pesanan.detail",compact('pesanan', 'nikJasa'));
    }

    public function konfirmasi_admin(Request $request, $id){
        $pesanan = Pesanan::find($id);
        $pesanan->id_status_layanan = "S";
        $pesanan->save();
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        return redirect()->route("pesanan.detail",['id'=>$id]);
        // return view("admin.pesanan.detailPesanan",compact('pesanan', 'nikJasa'));
    }

    public function tolak_admin(Request $request, $id){
        $pesanan = Pesanan::find($id);
        $pesanan->id_status_layanan = "T";
        $pesanan->save();
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        // return redirect()->route("pesanan.detail");
        return redirect()->route("pesanan.detail",['id'=>$id]);
        // return view("admin.pesanan.detailPesanan",compact('pesanan', 'nikJasa'));
    }

    public function hapuspembayaran_admin(Request $request, $id){
        $pesanan = Pesanan::find($id);
        $pesanan->bukti_pembayaran = NULL;
        $pesanan->save();
        $pesanan = Pesanan::find($id);
        $nikJasa = Users::where('status', '=', $pesanan->id_status_jasa)->get();
        return redirect()->route("pesanan.detail",['id'=>$id]);
    }
    public function addView($id)
    {
        // $jasa = StatusUser::all();
        $layanan = Layanan::find($id);
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        $alamat = Alamat::where('id_user', '=', Auth::user()->id)->get();
        // dd($jasa);
        return view("pasien.pesanan.add",compact('layanan','jasa','alamat'));        
    }
    public function add(Request $request,$id)
    {
        // $this->authorize('create', Pesanan::class); // Cuma bisa pasien yang pesan
        $layanan = Layanan::find($id);
        $validation = $request->validate([
            'id_status_jasa' =>'required',
            'alamat' =>'required',
            'foto' => 'file|image',
            'tanggal_perawatan' =>'required',
            'jam_perawatan' =>'required',
        ],
        [
            'id_status_jasa.required' => 'Silahkan pilih jasa yang anda inginkan !',
            'alamat.required' => 'Silahkan isi alamat anda !',
            'tanggal_perawatan.required' => 'Silahkan pilih tanggal untuk perawatan !',
            'jam_perawatan.required' => 'Silahkan pilih waktu untuk perawatan !',
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
        $alamat = Alamat::find($request->alamat);
        $alamat = $alamat->alamat;       
        $pesanan->id_pasien = Auth::user()->id;
        $pesanan->id_layanan = $layanan->id;
        $pesanan->id_status_jasa = $request->id_status_jasa;
        $pesanan->id_status_layanan = "M";
        $pesanan->alamat = $alamat;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->keluhan = $request->keluhan;       
        $pesanan->status_pembayaran = "T"; 
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;
        $pesanan->jam_perawatan = $request->jam_perawatan;

        $pesanan->save();
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        $alamat = Alamat::where('id_user', '=', Auth::user()->id)->get();
        $request->session()->flash("info","Data Pesanan anda berhasil disimpan!");
        return view("pasien.pesanan.add",compact('layanan','jasa','alamat'));
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
        // $statusJasa = HargaLayanan::where('id_layanan', '=', $pesanan->id_layanan)->get();
        $statusJasa = StatusUser::where('is_active', '=', 'Y')
                                ->where('id', '!=', 'A')
                                ->where('id', '!=', 'P')
                                ->get();
        $layanan = Layanan::all();
        $statusLayanan = StatusLayanan::all();
        $coba = $pesanan->id_layanan;        
        return view("admin.pesanan.update",compact('pesanan','layanan','statusJasa','nikJasa','statusLayanan','coba'));
    }
    public function updateByAdmin(Request $request, $id, Pesanan $pesanan)
    {
        // dd($request->all());
        $validation = $request->validate([
            'foto' => 'file|image',
            'status_jasa' =>'required',
            'id_jasa' =>'required'
        ],
        [
            'status_jasa.required' => 'Silahkan pilih jasa !',
            'id_jasa.required' => 'Silahkan pilih staff medis !'
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
        if($request->bukti_pembayaran)
        {
            $ext = $request->bukti_pembayaran->getClientOriginalExtension();
            $namafile = 'pembayaran'.Auth::user()->NIK.'-'.time().".".$ext;
            $path = $request->bukti_pembayaran->storeAs("public", $namafile);
            $pesanan->bukti_pembayaran = $namafile;
        }        
        $pesanan->id_layanan = $request->layanan;
        $pesanan->id_status_jasa = $request->status_jasa;
        $pesanan->id_jasa = $request->id_jasa;
        $pesanan->alamat = $request->alamat;
        $pesanan->keluhan = $request->keluhan;
        $pesanan->harga = $hargajasalayanan[0]->harga;
        $pesanan->id_status_layanan = $request->id_status_layanan;
        if($pesanan->bukti_pembayaran){
            $pesanan->status_pembayaran = 'Y';
        }else{
            $pesanan->status_pembayaran = 'T';
        }
        
        $pesanan->tanggal_perawatan = $request->tanggal_perawatan;

        // kalau jam_perawatannya sudah dalam bentuk hh:mm:ss
        if(strlen(strval($request->jam_perawatan)) > 5){
            $pesanan->jam_perawatan = $request->jam_perawatan;
        } 
        // kalau jam_perawatannya masih dalam bentuk hh:mm
        else {
            $pesanan->jam_perawatan = $request->jam_perawatan.":00";
        }

        $pesanan->save();
        $pesanan = Pesanan::find($id);

        // dd($hargajasalayanan);
        
        // return redirect()->route("pesanan.main");
        return view("admin.pesanan.detailPesanan",compact('pesanan'));
    }

    public function updatePerawatByAdmin(Request $request, $id, Pesanan $pesanan)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->id_jasa = $request->id_jasa;
        $pesanan->save();
        return redirect()->route("pesanan.detail",['id'=>$id]);
    }

    // public function konfirmasiByAdmin(Request $request, $id, Pesanan $pesanan)
    // {
    //     $validation = $request->validate([
    //         '' => 'silahkan pilih jasa !',
    //     ]);
    //     $pesanan = Pesanan::find($id);
    //     $pesanan->id_status_layanan = "SB";
    //     $pesanan->save();

    //     return redirect()->route("pesanan.main");
    // }

    public function batalPesanan($id, Pesanan $pesanan)
    {
        // dd($request->all());

        $pesanan = Pesanan::find($id);   
        $pesanan->id_status_layanan = "B";
        $pesanan->save();

        // dd($hargajasalayanan);
        return redirect()->route("pasien.profile");
    }
}
