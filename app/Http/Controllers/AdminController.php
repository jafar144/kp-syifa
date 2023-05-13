<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Users;
use App\Models\StatusUser;
use App\Models\Pesanan;
use App\Rules\NikDateRule;
use App\Models\StatusPesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Exports\StaffExport;
use App\Exports\LayananExport;
use App\Exports\HargaLayananExport;
use App\Exports\PasienExport;
use App\Exports\PesananExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function reset_pass_pasien(Request $request, $id){
        $pasien = Users::find($id);
        $pasien->password = Hash::make($pasien->NIK);
        $pasien->save();

        $request->session()->flash("info","password berhasil direset");
        return redirect()->route("pasien.detail",['id'=>$id]);
    }

    public function exportPesanan(Request $request)
    {
        $from = date($request->from);
        $to = date($request->to);
        return (new PesananExport($from,$to))->download('pesanan_'.Carbon::now()->timestamp.'.xlsx');
    }

    public function exportStaff(){
        return (new StaffExport)->download('staff_'.Carbon::now()->timestamp.'.xlsx');
    } 

    public function exportLayanan(){
        return (new LayananExport)->download('layanan_'.Carbon::now()->timestamp.'.xlsx');
    }

    public function exportHargaLayanan(){
        return (new HargaLayananExport)->download('harga_layanan_'.Carbon::now()->timestamp.'.xlsx');
    }

    public function exportPasien(){
        return (new PasienExport)->download('pasien_'.Carbon::now()->timestamp.'.xlsx');
    }  

    public function daftarStaff(){
        $this->authorize('daftarStaffPasien', Users::class);
        $staff = Users::where('status', '!=', 'P')->where('status', '!=', 'A')->get();
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        $reqselected = ['all','all'];
        return view("admin.staff.daftarStaff",compact('staff','statusStaff','reqselected'));
    }

    public function daftarStaffFilter(Request $request){
        if($request->status_staff == "all" && $request->is_active == "all"){
            $staff = Users::all();
        }else if($request->status_staff == "all" && $request->is_active != "all"){
            $staff = Users::where('is_active', '=', $request->is_active)->get();
        }else if($request->status_staff != "all" && $request->is_active == "all"){
            $staff = Users::where('status', '=', $request->status_staff)->get();
        }else{
            $staff = Users::where('status', '=', $request->status_staff)->where('is_active', '=', $request->is_active)->get();
        }
        $statusStaff = StatusUser::where('id','!=','P')->where('id','!=','A')->get();
        $reqselected = [$request->status_staff,$request->is_active];
        return view("admin.staff.daftarStaff",compact('staff','statusStaff','reqselected'));
    }

    public function daftarPasien(){
        $this->authorize('daftarStaffPasien', Users::class);
        $pasien = Users::where('status', '=', 'P')->get();
        return view("admin.pasien.daftarPasien",compact('pasien'));
    }

    public function daftarLayananFilter(Request $request){
        if($request->show == "all"){
            $layanan = Layanan::all();
        }else{
            $layanan = Layanan::all();
            $layanan = Layanan::where('show', '=', $request->show)->get();
        }
        $reqselected = [$request->show];
        return view("admin.layanan.daftarLayanan",compact('layanan','reqselected'));
    }

    public function daftarStatusStaffFilter(Request $request){
        if($request->aktif == "all"){
            $statusStaff = StatusUser::where('id', '!=', 'P')->where('id','!=','A')->get();
        }else{
            $statusStaff = StatusUser::where('id', '!=', 'P')->where('id','!=','A')->where('is_active', '=', $request->aktif)->get();
        }
        $reqselected = [$request->aktif];
        return view("admin.statusUser.daftarStatusStaff",compact('statusStaff','reqselected'));
    }

    public function daftarLayanan(){
        $this->authorize('daftarLayanan', Layanan::class);
        $layanan = Layanan::all();
        $reqselected = ['all'];
        return view("admin.layanan.daftarLayanan",compact('layanan','reqselected'));
    }

    public function daftarStatusStaff(){
        $this->authorize('daftarStatusStaff', StatusUser::class);
        $statusStaff = StatusUser::where('id', '!=', 'P')->where('id','!=','A')->get();
        $reqselected = ['all'];
        return view("admin.statusUser.daftarStatusStaff",compact('statusStaff','reqselected'));
    }

    public function daftarPesanan(){
        $this->authorize('daftarPesanan', Pesanan::class);
        $pesanan = Pesanan::where('id_status_pesanan', '=', 'M')->orderBy('created_at', 'DESC')->get();
        $statuspesanan = StatusPesanan::all();
        $layanans = Layanan::all();
        $reqselected = ['M','all','all'];
        $notif = count($pesanan);
        return view("admin.pesanan.daftarPesanan",compact('pesanan','statuspesanan','layanans','reqselected','notif'));
    }

    public function daftarPesananFilter(Request $request){        
        $pesanan = Pesanan::where('id_status_pesanan', '=', 'M')->orderBy('created_at', 'DESC')->get();
        if($request->id_status_pesanan == "all" && $request->id_layanan == "all" && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan !== "all" && $request->id_layanan == "all"  && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_status_pesanan', '=', $request->id_status_pesanan)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan == "all" && $request->id_layanan !== "all"  && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan == "all" && $request->id_layanan == "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan !== "all" && $request->id_layanan == "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('status_pembayaran', '=', $request->status_pembayaran)
            ->where('id_status_pesanan', '=', $request->id_status_pesanan)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan == "all" && $request->id_layanan !== "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('status_pembayaran', '=', $request->status_pembayaran)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan !== "all" && $request->id_layanan !== "all" && $request->status_pembayaran == "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('id_status_pesanan', '=', $request->id_status_pesanan)->orderBy('created_at', 'DESC')->get();
        }else if($request->id_status_pesanan !== "all" && $request->id_layanan !== "all" && $request->status_pembayaran !== "all")
        {
            $pesanan = Pesanan::where('id_layanan', '=', $request->id_layanan)
            ->where('id_status_pesanan', '=', $request->id_status_pesanan)
            ->where('status_pembayaran', '=', $request->status_pembayaran)->orderBy('created_at', 'DESC')->get();
        }

        $statuspesanan = StatusPesanan::all();
        $reqselected = [$request->id_status_pesanan,$request->id_layanan,$request->status_pembayaran];
        $layanans = Layanan::all();
        
        return view("admin.pesanan.daftarPesanan",compact('pesanan','statuspesanan','layanans','reqselected'));
    }

    public function addStaffView(){
        $this->authorize('tambahStaff', Users::class);
        $statusjasa = StatusUser::where('id','!=','A')->where('id','!=','P')->where('is_active','=','Y')->get();
        return view("admin.staff.addStaff",compact('statusjasa'));  
    }

    public function addStaff(Request $request){
        $this->authorize('tambahStaff', Users::class);
        $request->validate([
            'nama' =>'required|string|max:255',
            'NIK' => ['required', 'string', 'min:16', 'max:16', 'unique:users,NIK', new NikDateRule],
            'status' =>'required',
            'jenis_kelamin' => 'required|max:1',
            'notelp' => ['required','max:15', 'regex:/^(0|62)\d+$/'],
            'email' => 'nullable|string|email|unique:users,email',
        ],
        [
            'nama.required' => 'Nama harus diisi!',
            'nama.max' => 'Panjang nama tidak boleh lebih dari 255!',
            'NIK.required' => 'NIK harus diisi!',
            'NIK.min' => 'NIK harus diisi minimal 16 Angka!',
            'NIK.max' => 'NIK harus diisi maksimal 16 Angka!',
            'NIK.unique' => 'NIK sudah ada didalam daftar, silahkan masukkan NIK lain!',
            'status.required' => 'Status harus diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi!',
            'notelp.required' => 'Nomor Telepon harus diisi!',
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
        $staff = new Users();
        $staff->NIK = $request->NIK;
        $staff->nama = $request->nama;
        $staff->email = $request->email;
        $staff->password = $request->NIK;
        $tanggal = (int)substr($request->NIK, 6, 2);
        if($tanggal>40){
            $tanggal = $tanggal - 40;
            $tanggal = (string) $tanggal;
            $staff->tanggal_lahir = substr($request->NIK, 10, 2).'-'.substr($request->NIK, 8, 2).'-'.$tanggal;
        }else{
            $staff->tanggal_lahir = substr($request->NIK, 10, 2).'-'.substr($request->NIK, 8, 2).'-'.substr($request->NIK, 6, 2);
        }
        $staff->notelp = $noTelPush;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->status = $request->status;
        $staff->save();
        
        $request->session()->flash("info","Data $request->NIK berhasil disimpan!");
        return redirect()->route("staff.main");
    }
}