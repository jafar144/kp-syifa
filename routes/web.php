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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Baru untuk testing b
Route::get("/", function () {
    if(Auth::check()){
        if(Auth::user()->status === 'pasien'){
            return redirect('/homePasien');
        }
        else if(Auth::user()->status === 'admin'){
            return redirect('/pesananAdmin');
        }
    }
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//=================================================STATUS USER=============================================================================
use App\Http\Controllers\StatusUserController;
Route::get("/statusUser",[StatusUserController::class,'main'])->name('statususer.main');
Route::get("/statusUser/detail/{id}",[StatusUserController::class,'detail'])->name('statususer.detail');
Route::get("/statusUser/addView",[StatusUserController::class,'addView'])->name('statususer.addView');
Route::post("/statusUser/add",[StatusUserController::class,'add'])->name('statususer.add');
Route::get("/statusUser/updateView/{id}",[StatusUserController::class,'updateView'])->name('statususer.updateView');
Route::patch("/statusUser/update/{id}",[StatusUserController::class,'update'])->name('statususer.update');
Route::delete("/statusUser/delete/{id}",[StatusUserController::class,'delete']);
