<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusUserController;
use App\Http\Controllers\StatusLayananController;
Route::get('/', function () {
    return redirect('login');
});

// Baru untuk testing b
Route::get("/dashboard", function () {
    if(Auth::check()){
        if(Auth::user()->status === 'P'){
            return redirect('/home');
        }
        else if(Auth::user()->status === 'A'){
            return redirect('/daftarPesanan');
        }
    }
})->middleware(['auth','verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// =================================================Admin=================================================
// main
Route::get("/daftarPesanan",[AdminController::class,'daftarPesanan'])->name('pesanan.main');
Route::get("/daftarStaff",[AdminController::class,'daftarStaff']);
Route::get("/daftarPasien",[AdminController::class,'daftarPasien']);
Route::get("/daftarLayanan",[AdminController::class,'daftarLayanan']);
Route::get("/daftarStatusStaff",[AdminController::class,'daftarStatusStaff']);
//filter
Route::post("/daftarPesanan",[AdminController::class,'daftarPesananFilter']);
Route::post("/daftarStaff",[AdminController::class,'daftarStaffFilter']);
Route::post("/daftarLayanan",[AdminController::class,'daftarLayananFilter']);
Route::post("/daftarStatusStaff",[AdminController::class,'daftarStatusStaffFilter']);
//crud layanan
Route::get("/daftarLayanan/addView",[LayananController::class,'addView'])->name('layanan.addView');
Route::get("/detailLayanan/{id}",[LayananController::class,'detail']);

Route::get("/detailPasien/{id}",[UserController::class,'detail']);

// search
Route::get('/daftarPasien/search',[UserController::class,'searchPasien']);
Route::get('/daftarStaff/search',[UserController::class,'searchStaff']);
Route::get('/daftarPesanan/search',[PesananController::class,'search']);
Route::get('/daftarLayanan/search',[LayananController::class,'search']);
Route::get('/daftarStatusStaff/search',[StatusUserController::class,'search']);

Route::get("/daftarStatusStaff/addView",[StatusUserController::class,'addView'])->name('statususer.addView');
Route::post("/daftarStatusStaff/add",[StatusUserController::class,'add'])->name('statususer.add');

Route::get("/detailPesanan/{id}",[PesananController::class,'detail_admin'])->name('pesanan.detail');
Route::get("/detailPesanan/konfirm/{id}",[PesananController::class,'konfirmasi_admin'])->name('pesanan.konfirm');
// =================================================Pasien=================================================
// home
Route::get("/home",[PasienController::class,'home'])->name('pasien.home');
Route::get('/home/search',[PasienController::class,'search']);
// profile
Route::get("/profile",[PasienController::class,'profile'])->name('pasien.profile');
Route::get("/profile/editProfile",[PasienController::class,'editProfileView']);
Route::patch("/profile/update/{id}",[PasienController::class,'updateProfile']);

// pesan = home -> detail -> pesan
Route::get("/layanan/{id}",[PasienController::class,'detailLayanan'])->name('layanan.detail');

Route::get("/pesan/{id}",[PesananController::class,'addView'])->name('pesanan.addView');
Route::post("/pesan/{id}",[PesananController::class,'add'])->name('pesanan.add');
Route::get("/batalPesanan/{id}",[PesananController::class,'batalPesanan']);

//=================================================STATUS USER=============================================================================

Route::get("/statusUser",[StatusUserController::class,'main'])->name('statususer.main');
Route::get("/statusUser/detail/{id}",[StatusUserController::class,'detail'])->name('statususer.detail');
// Route::get("/statusUser/addView",[StatusUserController::class,'addView'])->name('statususer.addView');

Route::get("/statusUser/updateView/{id}",[StatusUserController::class,'updateView'])->name('statususer.updateView');
Route::patch("/statusUser/update/{id}",[StatusUserController::class,'update'])->name('statususer.update');
Route::delete("/statusUser/delete/{id}",[StatusUserController::class,'delete']);

//=================================================LAYANAN=============================================================================
Route::post("/daftarLayanan/add",[LayananController::class,'add'])->name('layanan.add');
Route::get("/daftarLayanan/updateView/{id}",[LayananController::class,'updateView'])->name('layanan.updateView');
Route::patch("/daftarLayanan/update/{id}",[LayananController::class,'update'])->name('layanan.update');
Route::delete("/daftarLayanan/delete/{id}",[LayananController::class,'delete']);

//=================================================STATUS LAYANAN=============================================================================

Route::get("/statusLayanan",[StatusLayananController::class,'main'])->name('statuslayanan.main');
Route::get("/statusLayanan/detail/{id}",[StatusLayananController::class,'detail'])->name('statuslayanan.detail');
Route::get("/statusLayanan/addView",[StatusLayananController::class,'addView'])->name('statuslayanan.addView');
Route::post("/statusLayanan/add",[StatusLayananController::class,'add'])->name('statuslayanan.add');
Route::get("/statusLayanan/updateView/{id}",[StatusLayananController::class,'updateView'])->name('statuslayanan.updateView');
Route::patch("/statusLayanan/update/{id}",[StatusLayananController::class,'update'])->name('statuslayanan.update');
Route::delete("/statusLayanan/delete/{id}",[StatusLayananController::class,'delete']);

//=================================================HARGA LAYANAN=============================================================================
use App\Http\Controllers\HargaLayananController;
Route::get("/hargaLayanan",[HargaLayananController::class,'main'])->name('hargalayanan.main');
Route::get("/hargaLayanan/detail/{id}",[HargaLayananController::class,'detail'])->name('hargalayanan.detail');
Route::get("/hargaLayanan/addView",[HargaLayananController::class,'addView'])->name('hargalayanan.addView');
Route::post("/hargaLayanan/add",[HargaLayananController::class,'add'])->name('hargalayanan.add');
Route::get("/hargaLayanan/updateView/{id}",[HargaLayananController::class,'updateView'])->name('hargalayanan.updateView');
Route::patch("/hargaLayanan/update/{id}",[HargaLayananController::class,'update'])->name('hargalayanan.update');
Route::delete("/hargaLayanan/delete/{id}",[HargaLayananController::class,'delete']);

//=================================================PESAN=============================================================================

Route::get("/pesan/updateView/{id}",[PesananController::class,'updateView'])->name('pesanan.updateView');
Route::patch("/pesan/update/{id}",[PesananController::class,'updateByAdmin'])->name('pesanan.update');
Route::patch("/pesan/updatePerawat/{id}",[PesananController::class,'updatePerawatByAdmin'])->name('pesanan.updatePerawat');
Route::delete("/pesan/delete/{id}",[PesananController::class,'delete']);

// Route::get('/', function () {
//     $layanan = App\Models\Layanan::all();
//     return view('pesanan.update',['layanan' => $layanan]);
// });

// Route::get('getJasa/{id}', function ($id) {
//     $status_jasa = App\Models\HargaLayanan::where('id_layanan',$id)->get();
//     return response()->json($status_jasa);
// });
Route::get("getJasa/{id}",[PesananController::class,'getStatusJasa']);
Route::get("getNik/{id}",[PesananController::class,'getNikJasa']);