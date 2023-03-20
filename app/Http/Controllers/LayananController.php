<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\StatusUser;
use Illuminate\Support\Facades\DB;
use App\Models\HargaLayanan;

class LayananController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Layanan::where('nama_layanan', 'like', '%' . $request->search . '%')->get();
            $output = '';
            $i = 1;
            if (count($data) > 0) {
                foreach($data as $item){   

                    // Check is_foto 
                    if($item->use_photo == 'Y'){
                        $use_foto = '<td style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>';
                    } else {
                        $use_foto = '<td class="text-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>';
                    }     
                    
                    // Check tampil
                    if($item->show == 'Y'){
                        $tampil = '<td style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>';
                    } else {
                        $tampil = '<td class="text-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>';
                    }   

                    $output .= '
                    <tr class="text-center montserrat-bold">                           
                        <td class="color-inti" scope="row">'.$i.'</td>
                        <td class="color-inti">'.$item->nama_layanan.'</td>

                        '.$use_foto.'

                        '.$tampil.'
                        
                        <td><a href="/detailLayanan/'.$item->id.'" class="btn btn-success" id="pesan-btn">Detail</a></td>                       
                    </tr>';
                    $i++;
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
        $statusjasa = StatusUser::all();
        return view("layanan.add",compact('statusjasa'));        
    }
    public function add(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            'nama_layanan' => 'required|unique:layanan,nama_layanan'
        ],
        [
            'nama_layanan.unique'=>'nama layanan sudah ada di database! silahkan masukkan layanan yang lain!',
            'nama_layanan.required' => 'nama layanan harus diisi !'
        ]
    );

        $layanan = new Layanan();
        $layanan->nama_layanan = $validation["nama_layanan"];
        $layanan->deskripsi = $request->deskripsi;
        $result = $layanan->save();
        if($result){

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
                $harga = array_values($harga);
                
                for($i=0; $i < count($request->jasa); $i++){
                    $hargalayanan = new HargaLayanan();
                    $hargalayanan->id_layanan = $layanan->id;
                    $hargalayanan->id_status_jasa = $request->jasa[$i];
                    $hargalayanan->harga = $harga[$i];
                    $hargalayanan->save();
                }
            }        
    
            $request->session()->flash("info","Data Layanan $request->nama_layanan berhasil disimpan!");
        }
        return redirect()->route("layanan.addView");
        
    }
    public function updateView(Request $request, $id)
    {
        $allJasa = StatusUser::all();
        $jasa = HargaLayanan::where('id_layanan', '=', $id)->get();
        $layanan = Layanan::find($id);
        // dd($jasa->all());
        // if($jasa->isEmpty()){
        //     dd("halo1");
        // }else{
        //     dd("halo2");
        // }
        
        return view("layanan.update",compact('layanan','jasa','allJasa'));
    }
    public function update(Request $request, $id, Layanan $layanan)
    {
        // dd($request->all());
        $validation = $request->validate([
            'nama_layanan' => 'required|unique:layanan,nama_layanan'
        ],
        [
            'nama_layanan.unique'=>'nama layanan sudah ada di database! silahkan masukkan layanan yang lain!',
            'nama_layanan.required' => 'nama layanan harus diisi !'
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
            for($i=0; $i < count($harga); $i++){
                if($harga[$i] == null)
                {
                    unset($harga[$i]);
                }
            }
            $harga = array_values($harga);
            
            for($i=0; $i < count($request->jasa); $i++){
                $hargalayanan = new HargaLayanan();
                $hargalayanan->id_layanan = $layanan->id;
                $hargalayanan->id_status_jasa = $request->jasa[$i];
                $hargalayanan->harga = $harga[$i];
                $hargalayanan->save();
            }
        }

        $request->session()->flash("info","Data Layanan $request->nama_layanan berhasil diupdate!");
        return redirect()->route("layanan.updateView",[$id]);
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