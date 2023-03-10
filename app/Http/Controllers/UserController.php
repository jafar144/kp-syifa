<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

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
}
