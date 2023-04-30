<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\NikDateRule;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Pesanan;
use App\Models\StatusUser;
use App\Models\HargaLayanan;
use App\Models\Alamat;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
                            <a href="url(/layanan/' .$item->id. ')" class="remove-underline">
                                <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">'.$item->nama_layanan.'</h5>
                                    <div class="card-body">
                                        <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">'.$item->deskripsi.'</p>
                                    </div>
                            </a>
                            <a type="button" href="url(/layanan/.' .$item->id. ') class="btn btn-primary my-2 ms-auto me-auto py-2 px-3" id="pesan-btn">Lihat</a>
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
        if(auth()->user()->status !== 'P') {
            abort(401);
        }
        $layanan = Layanan::find($id);
        $harga_layanan = HargaLayanan::where('id_layanan', '=', $id)->get();
        return view("pasien.layanan.detail",compact('layanan', 'harga_layanan'));
    }

    public function profile()
    {
        if(auth()->user()->status !== 'P') {
            abort(401);
        }
        $user = Users::find(Auth::user()->id);
        $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();
        $pesanan = Pesanan::where("id_pasien","=",Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view("pasien.profile", compact('user','pesanan','alamat'));
    }
    public function editProfileView()
    {
        if(auth()->user()->status !== 'P') {
            abort(401);
        }
        $user = Users::find(Auth::user()->id);
        return view("pasien.editProfile", compact('user'));
    }
    public function updateProfile(Request $request, $id, Users $user)
    {
        $validation = $request->validate([
            'NIK' => ['required', 'string', 'min:16', new NikDateRule],
            'nama' => 'required',
            'notelp' => ['required','max:15', 'regex:/^(0|62)\d+$/'],
            'tanggal_lahir' => 'required|before_or_equal:'.now()->format('Y-m-d')
        ],
        [
            'NIK.required' => 'NIK harus diisi!',
            'NIK.min' => 'NIK minimal 16 huruf',
            'nama.required' => 'Nama harus diisi!',
            'notelp.required' => 'Nomor Telepon harus diisi!',
            'tanggal_lahir.required' => 'Tanggal Lahir harus diisi!',
            'tanggal_lahir.before_or_equal' => 'Tanggal Lahir jangan lebih dari tanggal hari ini!'
        ]);
        
        $pasien = Users::find($id);
        $pasien->NIK = $request->NIK;
        $pasien->nama = $request->nama;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->save();
        $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();
        $user = Users::find(Auth::user()->id);
        $pesanan = Pesanan::where("id_pasien","=",Auth::user()->id)->get();
        return view("pasien.profile", compact('user','pesanan','alamat'));
    }

}
