<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusUser;
use Illuminate\Support\Facades\DB;

class StatusUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function main(){
        $statususer = StatusUser::all();
        return view("statususer.main",compact('statususer'));
    }
    public function detail(Request $request, $id)
    {
        $statususer = StatusUser::find($id);
        return view("statususer.detail",compact('statususer'));
    }
    public function addView()
    {
        return view("statususer.add");        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);
        $statususer = new StatusUser();
        $statususer->id = $request->id;
        $statususer->status = $request->status;
        $statususer->save();

        $request->session()->flash("info","Data Status User $request->status berhasil disimpan!");
        return redirect()->route("statususer.addView");
    }
    public function updateView(Request $request, $id)
    {
        $statususer = StatusUser::find($id);
        return view("statususer.update",compact('statususer'));
    }
    public function update(Request $request, $id, StatusUser $statususer)
    {
        $validation = $request->validate([
            'status' => 'required'
        ]);
        $statususer = StatusUser::find($id);
        $statususer->status = $request->status;
        $statususer->save();
        
        $request->session()->flash("info","Data Status User $request->status berhasil diupdate!");
        return redirect()->route("statususer.updateView",[$id]);
    }
    public function delete(Request $request, $id, StatusUser $statususer)
    {
        $statususer = StatusUser::find($id);
        if($statususer->id){
            $statususer->delete();
        }
        $request->session()->flash("info","Data Status User $request->status berhasil dihapus!");
        return redirect()->route("statususer.main");
    }
}
