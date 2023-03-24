<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\NikDateRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'NIK' => ['required', 'string', 'min:16', 'max:16', 'unique:'.User::class, new NikDateRule],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'notelp' => ['required','max:15', 'regex:/^(0|62)\d+$/'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Cek kalau nomor telepon yang diisi oleh user diawali 62 atau 0
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

        // Cek kalau tanggal di NIK untuk perempuan (+ 40)
        $tanggalNikPush = "";
        $tanggalNik = substr($request->NIK, 6, 2);
        if((int) $tanggalNik > 40) {
            
        }

        $user = User::create([
            'nama' => Str::title($request->nama),
            'NIK' => $request->NIK,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => substr($request->NIK, 10, 2).'-'.substr($request->NIK, 8, 2).'-'.substr($request->NIK, 6, 2),
            'notelp' => $noTelPush,
            'email' => $request->email,
            'status' => $request->status ?? 'P',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
