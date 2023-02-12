<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Baru untuk testing b
Route::get("/dashboard", function () {
    if(Auth::check()){
        if(Auth::user()->status === 'P'){
            return redirect('/homePasien');
        }
        else if(Auth::user()->status === 'A'){
            return redirect('/pesananAdmin');
        }
    }
})->middleware(['auth','verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Pasien
use App\Http\Controllers\PasienController;
Route::get("/homePasien",[PasienController::class,'home'])->name('pasien.home');
Route::get('/homePasien/search',[PasienController::class,'search']);

//=================================================STATUS USER=============================================================================
use App\Http\Controllers\StatusUserController;
Route::get("/statusUser",[StatusUserController::class,'main'])->name('statususer.main');
Route::get("/statusUser/detail/{id}",[StatusUserController::class,'detail'])->name('statususer.detail');
Route::get("/statusUser/addView",[StatusUserController::class,'addView'])->name('statususer.addView');
Route::post("/statusUser/add",[StatusUserController::class,'add'])->name('statususer.add');
Route::get("/statusUser/updateView/{id}",[StatusUserController::class,'updateView'])->name('statususer.updateView');
Route::patch("/statusUser/update/{id}",[StatusUserController::class,'update'])->name('statususer.update');
Route::delete("/statusUser/delete/{id}",[StatusUserController::class,'delete']);

//=================================================LAYANAN=============================================================================
use App\Http\Controllers\LayananController;
Route::get("/daftarLayanan",[LayananController::class,'main'])->name('layanan.main');
Route::get("/daftarLayanan/detail/{id}",[LayananController::class,'detail'])->name('layanan.detail');
Route::get("/daftarLayanan/addView",[LayananController::class,'addView'])->name('layanan.addView');
Route::post("/daftarLayanan/add",[LayananController::class,'add'])->name('layanan.add');
Route::get("/daftarLayanan/updateView/{id}",[LayananController::class,'updateView'])->name('layanan.updateView');
Route::patch("/daftarLayanan/update/{id}",[LayananController::class,'update'])->name('layanan.update');
Route::delete("/daftarLayanan/delete/{id}",[LayananController::class,'delete']);

//=================================================STATUS LAYANAN=============================================================================
use App\Http\Controllers\StatusLayananController;
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
use App\Http\Controllers\PesananController;
Route::get("/pesan/addView/{id}",[PesananController::class,'addView'])->name('pesanan.addView');
Route::post("/pesan/add/{id}",[PesananController::class,'add'])->name('pesanan.add');
Route::get("/pesan/detail/{id}",[PesananController::class,'detail'])->name('pesanan.detail');
Route::get("/pesan/main",[PesananController::class,'main'])->name('pesanan.main');
Route::get("/pesan/updateView/{id}",[PesananController::class,'updateView'])->name('pesanan.updateView');
Route::patch("/pesan/update/{id}",[PesananController::class,'updateByAdmin'])->name('pesanan.update');
Route::delete("/pesan/delete/{id}",[PesananController::class,'delete']);