<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\StatusUser;

class UserController extends Controller
{
    public function detail(Request $request, $id)
    {
        $pasien = Users::find($id);
        return view("admin.pasien.detailPasien",compact('pasien'));
    }
    public function searchPasien(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            // $data = Users::where('status', '=', 'P')->where('nama', 'like', '%' . $request->search . '%')->orWhere('NIK', 'like', '%' . $request->search . '%')->get();
            $data = Users::where('status', '=', 'P')
            ->where(function($q)use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('NIK', 'like', '%' . $request->search . '%');
            })->get();
            $output = '';
            $i = 1;
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row">'.$i.'</td>
                        <td class="color-inti">'.$item->NIK.'</td>
                        <td class="color-inti">'.$item->nama.'</td>
                        <td class="color-abu-tuo">+'.$item->phoneNumber($item->notelp).'</td>
                        <td><a href="/detailPasien/'.$item->id.'" class="btn btn-success" id="pesan-btn">Detail</a></td>                       
                    </tr>';
                    $i++;
                }
            } else {
                $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td class="color-abu-tuo"></td>
                        <td></td>                       
                    </tr>';
            }
            return $output;
        }
    }

    public function detailStaff(Request $request, $id)
    {
        $staff = Users::find($id);
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        return view("admin.staff.detailStaff",compact('staff', 'statusStaff'));
    }

    public function searchStaff(Request $request)
    {
        if ($request->ajax()) {
            $data = Users::where('status', '!=', 'P')
            ->where('status', '!=', 'A')
            ->where(function($q)use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('NIK', 'like', '%' . $request->search . '%');
            })->get();
            $output = '';
            $i = 1;
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row">'.$i.'</td>
                        <td class="color-inti">'.$item->NIK.'</td>
                        <td class="color-inti">'.$item->nama.'</td>
                        <td class="color-abu-tuo">'.$item->status_user->status.'</td>
                        <td>
                            <div class='.$item->is_active.'>'.$item->status_active($item->is_active).'</div>
                        </td>
                        <td><a href="/detailPasien/'.$item->id.'" class="btn btn-success" id="pesan-btn">Detail</a></td>                         
                    </tr>';
                    $i++;
                }
            } else {
                $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td class="color-abu-tuo"></td>
                        <td class="color-abu-tuo"></td>
                        <td></td>                       
                    </tr>';
            }
            return $output;
        }
    }

    public function updateStaffView(Request $request, $id)
    {
        $staff = Users::find($id);
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        return view("admin.staff.updateStaff",compact('staff','statusStaff'));
    }

    public function updateStaff(Request $request, $id)
    {
        $request->validate([
            'nama' =>'required|string|max:255',
            'NIK' => 'required|min:16|max:16|unique:users,NIK,'.$id,
            'alamat' =>'required',
            'jenis_kelamin' => 'required|max:1',
            'notelp' => ['required','max:15', 'regex:/^(0|62)\d+$/'],
            'email' => 'nullable|string|email|unique:users,email,'.$id
        ]);

        $noTelPush = "";
        if(substr($request->notelp, 0, 2) == '62'){
            $noTelPush = $request->notelp;
        } 
        else if(substr($request->notelp, 0, 1) == '0'){
            $noTelPush = '62'.substr($request->notelp, 1);
        }
        else{
            $noTelPush = null;
        }

        $staff = Users::find($id);
        $staff->NIK = $request->NIK;
        $staff->nama = $request->nama;
        $staff->email = $request->email;
        $staff->password = $request->NIK;
        $staff->tanggal_lahir = substr($request->NIK, 10, 2).'-'.substr($request->NIK, 8, 2).'-'.substr($request->NIK, 6, 2);
        $staff->notelp = $noTelPush;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->status = $request->status;
        $staff->alamat = $request->alamat;
        $staff->is_active = $request->has('is_active') ? "Y" : "T";
        $staff->save();
        
        $request->session()->flash("info", "Data $request->NIK berhasil diupdate!");
        return redirect()->route("staff.updateView",['id'=>$id]);
    }
}
