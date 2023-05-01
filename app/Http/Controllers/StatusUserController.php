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
            if (count($data) > 0) {
                foreach($data as $item){         
                    $output .= '
                    <tr class="text-center montserrat-bold">                           
                        <td class="color-inti vertical_space" scope="row">'.$i.'</td>
                        <td class="color-inti vertical_space">'.$item->id.'</td>
                        <td class="color-inti vertical_space">'.$item->status.'</td>
                        <td>
                            <div class="'.$item->is_active.' vertical_space">'.$item->status_active($item->is_active).'</div>
                        </td>
                        <td><a href="'.url('/statusUser/'.$item->id).'" class="btn btn-success vertical_space" id="pesan-btn">Detail</a></td>                       
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
        $this->authorize('detailStatusStaff', StatusUser::class);
        $statususer = StatusUser::find($id);
        return view("admin.statusUser.detail",compact('statususer'));
    }
    public function addView()
    {
        $this->authorize('tambahStatusStaff', StatusUser::class);
        return view("admin.statusUser.add");        
    }
    public function add(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required|unique:status_user,id',
            'status' => 'required|unique:status_user,status'
        ],
        [
            'id.required' => 'Kode Status harus diisi',
            'id.unique' => 'Kode Status sudah ada di dalam daftar, silahkan masukkan Kode Status lain',
            'status.unique' => 'Status sudah ada di dalam daftar, silahkan masukkan Status lain',
            'status.required' => 'Status harus diisi'
        ]);
        if (strpos($request->status, '|') !== false){
            $error = "status tidak boleh mengandung simbol |";
            return redirect()->back()->withErrors($error);
        }elseif(strpos($request->id, '|') !== false){
            $error = "kode status tidak boleh mengandung simbol |";
            return redirect()->back()->withErrors($error);
        }else{
            $statususer = new StatusUser();
            $statususer->id = $request->id;
            $statususer->status = $request->status;
            $statususer->is_active = $request->has('is_active') ? "Y" : "T";
            $statususer->save();
        }

        $request->session()->flash("info","Data Status User $request->status berhasil disimpan!");
        return redirect()->route("statususer.main");
    }
    public function updateView(Request $request, $id)
    {
        $this->authorize('updateStatusStaff', StatusUser::class);
        $statususer = StatusUser::find($id);
        return view("admin.statusUser.update",compact('statususer'));
    }
    public function update(Request $request, $id, StatusUser $statususer)
    {
        $validation = $request->validate([
            'status' => 'required'
        ],
        [
            'status.required' => 'Status harus diisi'
        ]);
        $statususer = StatusUser::find($id);
        $statususer->status = $request->status;
        $statususer->is_active = $request->has('is_active') ? "Y" : "T";
        $statususer->save();
        
        $request->session()->flash("info","Status $request->status berhasil diupdate!");
        return redirect()->route("statususer.detail",[$id]);
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
