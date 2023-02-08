<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'min:16', 'max:16', 'unique:'.User::class],
            'alamat' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:1'],
            'noTel' => ['required', 'string', 'max:15'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => Str::title($request->name),
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'ttl' => substr($request->nik, 10, 2).'-'.substr($request->nik, 8, 2).'-'.substr($request->nik, 6, 2),
            'noTel' => $request->noTel,
            'email' => $request->email,
            'status' => $request->status ?? 'pasien',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
