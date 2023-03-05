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
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = StatusUser::where('status', 'like', '%'.$request->search.'%')->get();
            $output = '';
            $i = 1;
            // echo("halo");
            // $output = '<h3>'.$data.'<h3/>';
            // $output = '<h3>hai<h3/>';
            if (count($data) > 0) {
                foreach($data as $item){         
                    $output .= '
                    <tr class="text-center montserrat-bold">                           
                        <td class="color-inti" scope="row">'.$i.'</td>
                        <td class="color-inti">'.$item->id.'</td>
                        <td class="color-inti">'.$item->status.'</td>
                        <td>Detail</td>                       
                    </tr>';
                    $i++;
                }
            } else {
                $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td></td>                       
                    </tr>';
            }
            return $output;
        }
    }
    public function main(){
        $statususer = StatusUser::all();
        $jumlah = array();
        foreach($statususer as $value)
        {
            $jumlahStatus = DB::select("select count(status) from users where status like '$value->id'");
            array_push($jumlah, $jumlahStatus);
        }
        $angka = array();
        for($i = 0; $i < count($jumlah); $i++)
        {
            array_push($angka, get_object_vars($jumlah[$i][0]));
        }
        return view("statususer.main",compact('statususer','angka'));
    }
    public function detail(Request $request, $id)
    {
        $statususer = StatusUser::find($id);
        return view("statususer.detail",compact('statususer'));
    }
    public function addView()
    {
        return view("admin.statusUser.add");        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required|unique:status_user,id',
            'status' => 'required|unique:status_user,status'
        ],
        [
            'id.required' => 'id harus diisi',
            'id.unique' => 'id sudah ada di dalam daftar, silahkan masukkan id lain',
            'status.unique' => 'status sudah ada di dalam daftar, silahkan masukkan status lain',
            'status.required' => 'status harus diisi'
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
        ],
        [
            'status.required' => 'status harus diisi'
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
