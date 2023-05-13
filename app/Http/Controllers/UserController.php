<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\StatusUser;
use App\Models\Alamat;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function detail(Request $request, $id)
    {
        $this->authorize('detailStaffPasien', Users::class);
        $pasien = Users::find($id);
        $alamat = Alamat::where('id_user',"=",$id)->get();
        return view("admin.pasien.detailPasien",compact('pasien','alamat'));
    }

    public function detailStaff(Request $request, $id)
    {
        $this->authorize('detailStaffPasien', Users::class);
        $staff = Users::find($id);
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        return view("admin.staff.detailStaff",compact('staff', 'statusStaff'));
    }

    public function updateStaffView(Request $request, $id)
    {
        $this->authorize('updateStaffPasien', Users::class);
        $staff = Users::find($id);
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        return view("admin.staff.updateStaff",compact('staff','statusStaff'));
    }

    public function updateStaff(Request $request, $id)
    {
        $this->authorize('updateStaffPasien', Users::class);
        $request->validate([
            'nama' =>'required|string|max:255',
            'NIK' => 'required|min:16|max:16|unique:users,NIK,'.$id,
            'jenis_kelamin' => 'required|max:1',
            'notelp' => ['required', 'min:10', 'max:15', 'regex:/^(0|62)\d+$/'],
            'email' => 'nullable|string|email|unique:users,email,'.$id
        ],
        [
            'nama.required' => 'Nama harus diisi!',
            'nama.max' => 'Panjang nama tidak boleh lebih dari 255!',
            'NIK.required' => 'NIK harus diisi!',
            'NIK.min' => 'NIK harus diisi minimal 16 Angka!',
            'NIK.max' => 'NIK harus diisi maksimal 16 Angka!',
            'NIK.unique' => 'NIK sudah ada didalam daftar, silahkan masukkan NIK lain!',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'notelp.required' => 'Nomor Telepon harus diisi!',
            'notelp.min' => 'Nomor Telepon harus diisi minimal 10 Angka!',
            'notelp.max' => 'Nomor Telepon harus diisi maksimal 15 Angka!',
            'notelp.regex' => 'Nomor Telepon harus diawali dengan 0 atau 62!',
            'email.email' => 'Masukkan format email dengan benar!',
            'email.unique' => 'Email sudah ada didalam daftar, silahkan masukkan email lain!',
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
        $staff->is_active = $request->has('is_active') ? "Y" : "T";
        $staff->save();
        
        $request->session()->flash("info", "Data $request->nama berhasil diupdate!");
        return redirect()->route("staff.detail",['id'=>$id]);
    }

    public function updatePasienView(Request $request, $id)
    {
        $this->authorize('updateStaffPasien', Users::class);
        $pasien = Users::find($id);
        return view("admin.pasien.updatePasien",compact('pasien'));
    }

    public function updatePasien(Request $request, $id)
    {
        $this->authorize('updateStaffPasien', Users::class);
        $request->validate([
            'nama' =>'required|string|max:255',
            'NIK' => 'required|min:16|max:16|unique:users,NIK,'.$id,
            'jenis_kelamin' => 'required|max:1',
            'notelp' => ['required', 'min:10', 'max:15', 'regex:/^(0|62)\d+$/'],
            'email' => 'nullable|string|email|unique:users,email,'.$id
        ],
        [
            'nama.required' => 'Nama harus diisi!',
            'nama.max' => 'Panjang nama tidak boleh lebih dari 255!',
            'NIK.required' => 'NIK harus diisi!',
            'NIK.min' => 'NIK harus diisi minimal 16 Angka!',
            'NIK.max' => 'NIK harus diisi maksimal 16 Angka!',
            'NIK.unique' => 'NIK sudah ada didalam daftar, silahkan masukkan NIK lain!',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'notelp.required' => 'Nomor Telepon harus diisi!',
            'notelp.min' => 'Nomor Telepon harus diisi minimal 10 Angka!',
            'notelp.max' => 'Nomor Telepon harus diisi maksimal 15 Angka!',
            'notelp.regex' => 'Nomor Telepon harus diawali dengan 0 atau 62!',
            'email.email' => 'Masukkan format email dengan benar!',
            'email.unique' => 'Email sudah ada didalam daftar, silahkan masukkan email lain!',
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

        $pasien = Users::find($id);
        $pasien->NIK = $request->NIK;
        $pasien->nama = $request->nama;
        $pasien->email = $request->email;
        $pasien->tanggal_lahir = substr($request->NIK, 10, 2).'-'.substr($request->NIK, 8, 2).'-'.substr($request->NIK, 6, 2);
        $pasien->notelp = $noTelPush;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->is_active = $request->has('is_active') ? "Y" : "T";
        $pasien->save();
        
        $request->session()->flash("info", "$request->nama berhasil diupdate!");
        return redirect()->route("pasien.detail",['id'=>$id]);
    }
}
