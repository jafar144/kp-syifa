<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
class AlamatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function alamat_pasien(){
        if (auth()->user()->status !== 'P') {
            abort(401);
        }
        $alamat = Alamat::where('id_user',"=",Auth::user()->id)->get();        
        return view("pasien.alamat.main",compact('alamat'));
    }
    public function getJarakAlamat($id)
    {
        $jarak = Alamat::where('id',$id)->get();
        return response()->json(['jarak'=>$jarak]);
    }
    public function addView()
    {
        if (auth()->user()->status !== 'P') {
            abort(401);
        }
        return view("pasien.alamat.add");        
    }
    public function updateView($id)
    {
        if (auth()->user()->status !== 'P') {
            abort(401);
        }
        $alamat = Alamat::find($id);
        return view("pasien.alamat.update",compact('alamat'));        
    }
    public function add(Request $request)
    {
        if (auth()->user()->status !== 'P') {
            abort(401);
        }
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
        $newalamat->jarak = intval($request->jarak);
        $newalamat->save();

        $request->session()->flash("info","Data alamat berhasil disimpan!");
        return redirect()->route("pasien.alamat");
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->status !== 'P') {
            abort(401);
        }
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
        $newalamat->jarak = $request->jarak;
        $newalamat->save();

        $request->session()->flash("info","Data alamat berhasil diupdate!");
        return redirect()->route("pasien.alamat");
    }

    public function delete(Request $request,$id)
    {
        $alamatdel = Alamat::find($id);
        // dd($alamatdel);
        if($alamatdel->id){
            $alamatdel->delete();
        }

        $request->session()->flash("info","Data alamat berhasil dihapus!");
        return redirect()->route("pasien.alamat");
    }
}
