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
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\StatusLayananController;

Route::get('/', function () {
    return redirect('login');
});

// Baru untuk testing b
Route::get("/dashboard", function () {
    if (Auth::check()) {
        if (Auth::user()->status === 'A') {
            return redirect('/daftarPesanan');
        } else if (Auth::user()->status === 'P') {
            return redirect('/home');
        }
    }
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// =================================================Admin=================================================
// main
Route::get("/daftarPesanan", [AdminController::class, 'daftarPesanan'])->name('pesanan.main');
Route::get("/daftarStaff", [AdminController::class, 'daftarStaff']);
Route::get("/daftarPasien", [AdminController::class, 'daftarPasien']);
Route::get("/daftarLayanan", [AdminController::class, 'daftarLayanan'])->name('layanan.main');
Route::get("/daftarStatusStaff", [AdminController::class, 'daftarStatusStaff']);

//filter
Route::post("/daftarPesanan", [AdminController::class, 'daftarPesananFilter']);
Route::post("/daftarStaff", [AdminController::class, 'daftarStaffFilter']);
Route::post("/daftarLayanan", [AdminController::class, 'daftarLayananFilter']);
Route::post("/daftarStatusStaff", [AdminController::class, 'daftarStatusStaffFilter']);
//crud layanan
Route::get("/daftarLayanan/addView", [LayananController::class, 'addView'])->name('layanan.addView');
Route::get("/detailLayanan/{id}", [LayananController::class, 'detail'])->name('layanan.detailLayanan');

Route::get("/detailPasien/{id}", [UserController::class, 'detail'])->name('pasien.detail');
Route::get("/daftarPasien/updateView/{id}", [UserController::class, 'updatePasienView'])->name('pasien.updateView');
Route::patch("/daftarPasien/update/{id}", [UserController::class, 'updatePasien'])->name('pasien.update');

Route::get("/detailStaff/{id}", [UserController::class, 'detailStaff'])->name('staff.detail');

// search
Route::get('/daftarPasien/search', [UserController::class, 'searchPasien']);
Route::get('/daftarStaff/search', [UserController::class, 'searchStaff']);
Route::get('/daftarPesanan/search', [PesananController::class, 'search']);
Route::get('/daftarLayanan/search', [LayananController::class, 'search']);
Route::get('/daftarStatusStaff/search', [StatusUserController::class, 'search']);

Route::get("/daftarStatusStaff/addView", [StatusUserController::class, 'addView'])->name('statususer.addView');
Route::post("/daftarStatusStaff/add", [StatusUserController::class, 'add'])->name('statususer.add');

Route::get("/detailPesanan/{id}", [PesananController::class, 'detail_admin'])->name('pesanan.detail');
Route::patch("/detailPesanan/konfirm/{id}", [PesananController::class, 'konfirmasi_admin']);
Route::patch("/detailPesanan/tolak/{id}", [PesananController::class, 'tolak_admin']);
Route::patch("/pesan/hapuspembayaran/{id}", [PesananController::class, 'hapuspembayaran_admin']);
//staff
Route::get("/daftarStaff/addView", [AdminController::class, 'addStaffView'])->name('staff.addView');
Route::post("/daftarStaff/add", [AdminController::class, 'addStaff']);
Route::get("/daftarStaff/updateView/{id}", [UserController::class, 'updateStaffView'])->name('staff.updateView');
Route::patch("/daftarStaff/update/{id}", [UserController::class, 'updateStaff'])->name('staff.update');

Route::get("/pesan/updateView/{id}", [PesananController::class, 'updateView'])->name('pesanan.updateView');
Route::patch("/pesan/update/{id}", [PesananController::class, 'updateByAdmin'])->name('pesanan.update');
Route::patch("/pesan/updatePerawat/{id}", [PesananController::class, 'updatePerawatByAdmin'])->name('pesanan.updatePerawat');
// =================================================Pasien=================================================
// home
Route::get("/home", [PasienController::class, 'home'])->name('pasien.home');
Route::get('/home/search', [PasienController::class, 'search']);
// profile
Route::get("/profile", [PasienController::class, 'profile'])->name('pasien.profile');
Route::get("/profile/editProfile", [PasienController::class, 'editProfileView']);
Route::patch("/profile/update/{id}", [PasienController::class, 'updateProfile']);

// alamat
Route::get("/profile/alamat", [AlamatController::class, 'alamat_pasien'])->name('pasien.alamat');
Route::get("/profile/alamat/addView", [AlamatController::class, 'addView'])->name('pasien.alamat.addview');
Route::get("/profile/alamat/updateView/{id}", [AlamatController::class, 'updateView'])->name('pasien.alamat.updateview');
Route::post("/profile/alamat/add", [AlamatController::class, 'add']);
Route::patch("/profile/alamat/update/{id}", [AlamatController::class, 'update']);
Route::delete("/profile/alamat/delete/{id}", [AlamatController::class, 'delete']);

// pesan = home -> detail -> pesan
Route::get("/layanan/{id}", [PasienController::class, 'detailLayanan'])->name('layanan.detail');
Route::get("/pesan/{id}", [PesananController::class, 'addView'])->name('pesanan.addView');
Route::post("/pesan/{id}", [PesananController::class, 'add'])->name('pesanan.add');
Route::get("/detailPesananPasien/{id}", [PesananController::class, 'detail_pasien']);
Route::patch("/batalPesanan/{id}", [PesananController::class, 'batalPesanan']);

//=================================================STATUS USER=============================================================================

Route::get("/statusUser", [StatusUserController::class, 'main'])->name('statususer.main');
Route::get("/statusUser/detail/{id}", [StatusUserController::class, 'detail'])->name('statususer.detail');
// Route::get("/statusUser/addView",[StatusUserController::class,'addView'])->name('statususer.addView');

Route::get("/statusUser/updateView/{id}", [StatusUserController::class, 'updateView'])->name('statususer.updateView');
Route::patch("/statusUser/update/{id}", [StatusUserController::class, 'update'])->name('statususer.update');
Route::delete("/statusUser/delete/{id}", [StatusUserController::class, 'delete']);

//=================================================LAYANAN=============================================================================
Route::post("/daftarLayanan/add", [LayananController::class, 'add'])->name('layanan.add');
Route::get("/daftarLayanan/updateView/{id}", [LayananController::class, 'updateView'])->name('layanan.updateView');
Route::patch("/daftarLayanan/update/{id}", [LayananController::class, 'update'])->name('layanan.update');
Route::delete("/daftarLayanan/delete/{id}", [LayananController::class, 'delete']);

//=================================================STATUS LAYANAN=============================================================================

Route::get("/statusLayanan", [StatusLayananController::class, 'main'])->name('statuslayanan.main');
Route::get("/statusLayanan/detail/{id}", [StatusLayananController::class, 'detail'])->name('statuslayanan.detail');
Route::get("/statusLayanan/addView", [StatusLayananController::class, 'addView'])->name('statuslayanan.addView');
Route::get("/statusLayanan/updateView/{id}", [StatusLayananController::class, 'updateView'])->name('statuslayanan.updateView');
Route::post("/statusLayanan/add", [StatusLayananController::class, 'add'])->name('statuslayanan.add');
Route::patch("/statusLayanan/update/{id}", [StatusLayananController::class, 'update'])->name('statuslayanan.update');
Route::delete("/statusLayanan/delete/{id}", [StatusLayananController::class, 'delete']);

//=================================================HARGA LAYANAN=============================================================================
use App\Http\Controllers\HargaLayananController;

Route::get("/hargaLayanan", [HargaLayananController::class, 'main'])->name('hargalayanan.main');
Route::get("/hargaLayanan/detail/{id}", [HargaLayananController::class, 'detail'])->name('hargalayanan.detail');
Route::get("/hargaLayanan/addView", [HargaLayananController::class, 'addView'])->name('hargalayanan.addView');
Route::get("/hargaLayanan/updateView/{id}", [HargaLayananController::class, 'updateView'])->name('hargalayanan.updateView');

Route::post("/hargaLayanan/add", [HargaLayananController::class, 'add'])->name('hargalayanan.add');
Route::patch("/hargaLayanan/update/{id}", [HargaLayananController::class, 'update'])->name('hargalayanan.update');
Route::delete("/hargaLayanan/delete/{id}", [HargaLayananController::class, 'delete']);

//=================================================PESAN=============================================================================

Route::delete("/pesan/delete/{id}", [PesananController::class, 'delete']);

Route::get("getJasa/{id}", [PesananController::class, 'getStatusJasa']);
Route::get("getNik/{id}", [PesananController::class, 'getNikJasa']);
Route::get("getJarak/{id}", [AlamatController::class, 'getJarakAlamat']);

// excel
// Route::get('/staff-export/{id}',[AdminController::class, 'exportStaff']);
Route::get('/staff-export', [AdminController::class, 'exportStaff']);
Route::get('/layanan-export', [AdminController::class, 'exportLayanan']);
Route::get('/hargalayanan-export', [AdminController::class, 'exportHargaLayanan']);
Route::get('/pasien-export', [AdminController::class, 'exportPasien']);
Route::post('/pesanan-export', [AdminController::class, 'exportPesanan']);
