<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
class AlamatController extends Controller
{
    public function alamat_pasien(){
        $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();        
        return view("pasien.alamat.main",compact('alamat'));
    }
    public function addView()
    {
        return view("pasien.alamat.add");        
    }
    public function updateView($id)
    {
        $alamat = Alamat::find($id);
        return view("pasien.alamat.update",compact('alamat'));        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'alamat' => 'required',
            'detail' => 'required'
        ],
        [
            'alamat.required' => 'alamat harus diisi',
            'detail.required' => 'detail alamat harus diisi'
        ]);

        $newalamat = new Alamat();
        $newalamat->id_user = Auth::user()->id;
        $newalamat->alamat = $request->alamat;
        $newalamat->detail = $request->detail;
        $newalamat->jarak = 0;
        $newalamat->save();

        $request->session()->flash("info","Data alamat berhasil disimpan!");
        return redirect()->route("pasien.alamat.addview");
        
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'alamat' => 'required',
            'detail' => 'required'
        ],
        [
            'alamat.required' => 'alamat harus diisi',
            'detail.required' => 'detail alamat harus diisi'
        ]);

        $newalamat = Alamat::find($id);
        $newalamat->alamat = $request->alamat;
        $newalamat->detail = $request->detail;
        $newalamat->jarak = 0;
        $newalamat->save();

        $request->session()->flash("info","Data alamat berhasil diupdate!");
        return redirect()->route("pasien.alamat.updateview",[$id]);
    }

    public function delete(Request $request,$id)
    {
        $alamatdel = Alamat::find($id);
        if($alamatdel->id){
            $alamatdel->delete();
        }

        // $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();
        $request->session()->flash("info","Data alamat berhasil dihapus!");
        return redirect()->route("pasien.alamat");
    }
}
