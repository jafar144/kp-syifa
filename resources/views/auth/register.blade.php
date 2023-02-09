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

    <title>Sign Up</title>

</head>

<body>
    <div class="signup">

        <!-- Sign Up -->
        <form method="POST" action="{{ route('register') }}" class="sign-up-form">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="" :errors="$errors" style="color: red; font-weight: 500;" />
            @csrf

            <h2 class="title">Sign Up</h2>

            <!-- NIK -->
            <div class="input-field">
                <i class="fa-solid fa-id-card"></i>
                <input id="NIK" type="number" placeholder="NIK" name="NIK" onKeyPress="if(this.value.length==16) return false;" min="16" :value="old('NIK')" required autofocus />
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

            <!-- Alamat Pasien -->
            <div class="input-field">
                <i class="fa-solid fa-location-dot"></i>
                <input id="alamat" type="text" placeholder="Alamat Pasien" name="alamat" :value="old('alamat')" required autofocus />
            </div>

            <!-- No.Telepon atau WA -->
            <div class="input-field">
                <i class="fa-solid fa-phone"></i>
                <input id="notelp" type="number" placeholder="No.Telp / WA" name="notelp" :value="old('notelp')" required autofocus />
            </div>

            <!-- Email -->
            <div class="input-field">
                <i class="fa-solid fa-envelope"></i>
                <input id="email" type="email" placeholder="Email (Opsional)" name="email" :value="old('email')" required autofocus />
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
            <button type="submit" class="btn solid">Sign Up</button>

            <!-- Login -->
            <div class="">
                <p class="color-abu">Sudah Punya Akun ? <a href="{{ url('/login') }}" class="remove_underline color-inti text-bold">Masuk Sini!</a></p>
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