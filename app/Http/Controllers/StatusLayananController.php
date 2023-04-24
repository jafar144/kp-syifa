<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusLayanan;
use Illuminate\Support\Facades\DB;

class StatusLayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function main(){
        $statuslayanan = StatusLayanan::all();
        return view("statuslayanan.main",compact('statuslayanan'));
    }
    public function detail(Request $request, $id)
    {
        $statuslayanan = StatusLayanan::find($id);
        return view("statuslayanan.detail",compact('statuslayanan'));
    }
    public function addView()
    {
        return view("statuslayanan.add");        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ],
        [
            'id.required' => 'id harus diisi',
            'status.required' => 'status harus diisi'
        ]);
        $statuslayanan = new StatusLayanan();
        $statuslayanan->id = $request->id;
        $statuslayanan->status = $request->status;
        $statuslayanan->save();

        $request->session()->flash("info","Data Status Layanan $request->status berhasil disimpan!");
        return redirect()->route("statuslayanan.addView");
    }
    public function updateView(Request $request, $id)
    {
        $statuslayanan = StatusLayanan::find($id);
        return view("statuslayanan.update",compact('statuslayanan'));
    }
    public function update(Request $request, $id, StatusLayanan $statuslayanan)
    {
        $validation = $request->validate([
            'status' => 'required'
        ],
        [
            'status.required' => 'status harus diisi'
        ]);
        $statuslayanan = StatusLayanan::find($id);
        $statuslayanan->status = $request->status;
        $statuslayanan->save();
        
        $request->session()->flash("info","Data Status Layanan $request->status berhasil diupdate!");
        return redirect()->route("statuslayanan.updateView",[$id]);
    }
    public function delete(Request $request, $id, StatusLayanan $statuslayanan)
    {
        $statuslayanan = StatusLayanan::find($id);
        if($statuslayanan->id){
            $statuslayanan->delete();
        }
        $request->session()->flash("info","Data Status Layanan $request->status berhasil dihapus!");
        return redirect()->route("statuslayanan.main");
    }
}
