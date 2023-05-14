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

    <title>Sign Up</title>

</head>

<body>
    <div class="w-100 h-100">
        <div class="row" style="height: 100%; margin: 0;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-md-flex d-none justify-content-center align-items-center">
                <img src="{{ asset('image/Logo_Klinik.png') }}" class="image_logo" id="image_logo" alt="" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex mt-5 mt-md-0 justify-content-center align-items-center">
                <div class="me-md-5 me-0 mt-4 mt-md-0">
                    <form method="POST" action="{{ route('register') }}" class="sign-up-form">

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="" :errors="$errors" style="color: red; font-weight: 500;" />
                        @csrf

                        <h2 class="title mt-0 mt-md-4 mb-0 text-bold">Sign Up</h2>

                        <div class="text-white">Halo ini teks fungsinya hanya untuk melebarkan</div>

                        <!-- NIK -->
                        <div class="input-field">
                            <i class="fa-solid fa-id-card"></i>
                            <input id="NIK" type="number" placeholder="NIK Pasien" name="NIK" onKeyPress="if(this.value.length==16) return false;" min="16" :value="old('NIK')" required autofocus />
                        </div>

                        <!-- Nama Pasien -->
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <input id="nama" type="text" placeholder="Nama Pasien" name="nama" :value="old('nama')" required />
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="input-field">
                            <i class="fa-solid fa-venus-mars"></i>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- No.Telepon atau WA -->
                        <div class="input-field">
                            <i class="fa-solid fa-phone"></i>
                            <input id="notelp" type="number" placeholder="No.Telp / WA" name="notelp" :value="old('notelp')" required autofocus />
                        </div>

                        <!-- Email -->
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input id="email" type="email" placeholder="Email (Opsional)" name="email" :value="old('email')" autofocus />
                        </div>

                        <!-- Password -->
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password" />
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input id="password_confirmation" type="password" placeholder="Konfirmasi Password" name="password_confirmation" required />
                        </div>
                        <button type="submit" class="loginBtn">Sign Up</button>

                        <!-- Login -->
                        <div class="mb-5">
                            <div class="mb-4">
                            <p class="color-abu">Sudah Punya Akun ? <a href="{{ url('/login') }}" class="remove_underline color-inti text-bold">Masuk Sini!</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>