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
    
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Layanan::where('nama_layanan', 'like', '%' . $request->search . '%')->paginate(10);
            $output = '';
            if (count($data) > 0) {
                foreach($data as $key => $item){   

                    // Check is_foto 
                    if($item->use_photo == 'Y'){
                        $use_foto = '<td class="text-center vertical_space" style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>';
                    } else {
                        $use_foto = '<td class="text-danger text-center vertical_space"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>';
                    }     
                    
                    // Check tampil
                    if($item->show == 'Y'){
                        $tampil = '<td class="text-center vertical_space" style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>';
                    } else {
                        $tampil = '<td class="text-danger text-center vertical_space"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>';
                    }   

                    $output .= '
                    <tr class="montserrat-bold">                           
                        <td class="color-inti text-center vertical_space " scope="row">'.$data->firstItem() + $key.'</td>
                        <td class="color-inti text-start nama_panjang vertical_space " style="width: fit-content;">'.$item->nama_layanan.'</td>

                        '.$use_foto.'

                        '.$tampil.'
                        
                        <td class="text-center vertical_space"><a href="/detailLayanan/'.$item->id.'" class="btn btn-success" id="pesan-btn">Detail</a></td>                       
                    </tr>';
                }
            } else {
                $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td></td>                       
                    </tr>';
            }
            return $output;
        }
    }

    public function detail(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $harga_layanan = HargaLayanan::where('id_layanan', '=', $id)->get();
        return view("admin.layanan.detailLayanan",compact('layanan', 'harga_layanan'));
    }

    public function addView()
    {
        $statusjasa = StatusUser::where('is_active', '=', 'Y')->get();
        return view("admin.layanan.add",compact('statusjasa'));        
    }

    public function add(Request $request)
    {
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
                // dd($harga);
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
        $allJasa = StatusUser::where('is_active', '=', 'Y')->get();
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        $layanan = Layanan::find($id);
        
        return view("admin.layanan.update",compact('layanan','jasa','allJasa'));
    }
    public function update(Request $request, $id, Layanan $layanan)
    {
        $validation = $request->validate([
            'nama_layanan' => 'required|unique:layanan,nama_layanan,'.$id,
            'harga'=>'required|array'
        ],        
        [
            // 'nama_layanan.unique'=>'nama layanan sudah ada di database! silahkan masukkan layanan yang lain!',
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

    // tidak digunakan
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