<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Logo Website -->
    <link rel="icon" href="{{ asset('image/Logo_Kliniks.png') }}">

    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Javascript -->
    <script src="https://kit.fontawesome.com/3996a8b58a.js" crossorigin="anonymous"></script>

    <title>Log in</title>

</head>

<body>
    <div class="signin">

        <!-- Sign In -->
        <form method="POST" action="{{ route('login') }}" class="sign-in-form">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color: red; font-weight: 500;" />

            <h2 class="title">Log in</h2>

            <!-- Username -->
            <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input id="login" type="text" placeholder="Email / No.Telp" name="login" :value="old('login')" required autofocus />
            </div>

            <!-- Password -->
            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input id="password" type="password" placeholder="Password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <!-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> -->

            <!-- Lupa Password -->
            <div class="lupa-password">
                @if (Route::has('password.request'))
                <a class="remove_underline color-inti" href="{{ route('password.request') }}">
                    {{ __('Lupa password ?') }}
                </a>
                @endif
            </div>
            <button type="submit" class="btn solid">LOGIN</button>

            <!-- Sign Up -->
            <div class="">
                <p class="color-abu">Belum Punya Akun ? <a href="{{ url('/register') }}" class="remove_underline color-inti text-bold">Daftar Sini!</a></p>
            </div>
        </form>
    </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <img src="{{ asset('image/Logo_Klinik.png') }}" class="image" alt="" />
        </div>
    </div>
</body>

</html>