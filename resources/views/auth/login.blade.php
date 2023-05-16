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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Javascript -->
    <script src="https://kit.fontawesome.com/3996a8b58a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Log in</title>

</head>

<body>

    <div class="w-100 h-100">
        <div class="row" style="height: 100%; margin: 0;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-md-flex d-none justify-content-center align-items-center">
                <img src="{{ asset('image/Logo_Klinik.png') }}" class="image_logo" id="image_logo" alt="" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex mt-5 mt-md-0 justify-content-center align-items-center">
                <div class="me-md-5 me-0 mt-4 mt-md-0">
                    <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                        @csrf


                        <x-auth-session-status class="mb-4" :status="session('status')" />


                        <x-auth-validation-errors class="mb-4" :errors="$errors" style="color: red; font-weight: 500;" />

                        <h2 class="title text-bold">Log in</h2>


                        <div class="color-inti text-bold" style="font-size: smaller;">* Login dengan Nomor telepon harus diawali "62"</div>
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <input id="login" type="text" placeholder="Email / No.Telp*" name="login" value="{{ old('login') }}" required autofocus />
                        </div>


                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" placeholder="Password" name="password" required autocomplete="current-password" />
                        </div>


                        <div class="ms-auto mt-1">
                            @if (Route::has('password.request'))
                            <a class="remove_underline color-inti" href="{{ route('password.request') }}">
                                {{ __('Lupa password ?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="loginBtn">LOGIN</button>


                        <div class="">
                            <p class="color-abu">Belum Punya Akun ? <a href="{{ url('/register') }}" class="remove_underline color-inti text-bold">Daftar Sini!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>