<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Pesanan;
use App\Models\StatusUser;
use App\Models\HargaLayanan;

class PasienController extends Controller
{
    public function home()
    {
        $layanan = Layanan::where("show","=","Y")->get();
        return view("pasien.homePasien", compact('layanan'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Layanan::where('nama_layanan', 'like', '%' . $request->search . '%')->where('show', '=', 'Y')->get();
            $output = '';
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                        <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="" style="height: 14rem;">
                            <a href='.url("/layanan/".$item->id).' class="remove-underline">
                                <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">'.$item->nama_layanan.'</h5>
                                    <div class="card-body">
                                        <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">'.$item->deskripsi.'</p>
                                    </div>
                            </a>
                            <a type="button" href='.url("/layanan/".$item->id).' class="btn btn-primary my-2 ms-auto me-auto py-2 px-3" id="pesan-btn">Lihat</a>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output .= '
                    <div class="montserrat-extra text-danger">Layanan Tidak Ditemukan!</div>
                ';
            }

            return $output;
        }
    }

    public function detailLayanan(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $harga_layanan = HargaLayanan::where('id_layanan', '=', $id)->get();
        return view("pasien.layanan.detail",compact('layanan', 'harga_layanan'));
    }

    public function profile()
    {
        $user = Users::find(Auth::user()->id);
        $pesanan = Pesanan::where("id_pasien","=",Auth::user()->id)->get();
        return view("pasien.profile", compact('user','pesanan'));
    }
    public function editProfileView()
    {
        $user = Users::find(Auth::user()->id);
        return view("pasien.editProfile", compact('user'));
    }
    public function updateProfile(Request $request, $id, Users $user)
    {
        
        $validation = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'notelp' => ['required','max:15', 'regex:/^(0|62)\d+$/'],
            'tanggal_lahir' => 'required'
        ],
        [
            'nama.required' => 'nama harus diisi !',
            'alamat.required' => 'alamat harus diisi !',
            'notelp.required' => 'nomor telfon harus diisi !',
            'tanggal_lahir.required' => 'tanggal lahir harus diisi !'
        ]);
        
        $pasien = Users::find($id);
        // dd($pasien->all());
        $pasien->nama = $request->nama;
        $pasien->alamat = $request->alamat;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->save();

        $user = Users::find(Auth::user()->id);
        $pesanan = Pesanan::where("id_pasien","=",Auth::user()->id)->get();
        return view("pasien.profile", compact('user','pesanan'));
    }

}
