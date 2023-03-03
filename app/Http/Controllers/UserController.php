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
    public function search(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $data = Users::where('nama', 'like', '%' . $request->search . '%')->where('status', '=', 'P')->get();
            $output = '';
            $i = 1;
            if (count($data) > 0) {
                foreach($data as $item){
                    $output .= '
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row">'.$i.'</td>
                        <td class="color-inti">'.$item->NIK.'</td>
                        <td class="color-inti">'.$item->nama.'</td>
                        <td>Detail</td>                       
                    </tr>
                    '
                    ;
                    $i++;
                }
            } else {
                $output .= '
                    <tr class="text-center montserrat-bold">
                        
                    <td class="color-inti" scope="row"></td>
                        <td class="color-inti"></td>
                        <td class="color-inti"></td>
                        <td>Detail</td>
                       
                    </tr>
                ';
            }

            return $output;
        }
    }
}
