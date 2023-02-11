<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function home()
    {
        $layanan = Layanan::all();
        return view("pasien.homePasien", compact('layanan'));
    }

    public function search(Request $request)
    {
        // $search = $request->search;
        // $layanan = Layanan::where('nama_layanan', 'like',"%".$search."%")->get();
        // return view('pasien.homePasien',compact('layanan'));
        if ($request->ajax()) {
            $data = Layanan::where('nama_layanan', 'like', '%' . $request->search . '%')->get();
            $output = '';
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                        <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="">
                            <a href='.url("/daftarLayanan/detail/".$item->id).' class="remove-underline">
                                <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">'.$item->nama_layanan.'</h5>
                                    <div class="card-body">
                                        <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">'.$item->deskripsi.'</p>
                                    </div>
                            </a>
                            <a type="button" href='.url("/daftarLayanan/detail/".$item->id).' class="btn btn-primary my-2 ms-auto me-auto py-2 px-3" id="pesan-btn">Lihat</a>
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
}
