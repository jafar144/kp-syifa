<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Logo Website -->
    <link rel="icon" type="image/x-icon" href="{{ asset('image/Logo_Kliniks.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sideBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://kit.fontawesome.com/3996a8b58a.css" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sideBar.js') }}"></script>
</head>

<body class="body-pd">
    <div class="l-navbar show">
        <nav class="nav">
            <div>
                <a href="{{ url('/pesananAdmin') }}" class="nav_logo remove_underline mt-3">
                    <img src="{{ asset('image/Logo_Kliniks.png') }}" alt="Logo Klinik" width="40" height="40">
                    <span class="nav_logo-name">Syifa</span>
                </a>
                <div class="nav_list">
                    <a href="{{ url('/pesananAdmin') }}" class="nav_link active remove_underline"><i class="fa-regular fa-file-lines nav_icon"></i>
                        <span class="nav_name">Pesanan</span>
                    </a>
                    <a href="{{ url('/daftarPasien') }}" class="nav_link remove_underline"><i class="fa-solid fa-user nav-icon"></i>
                        <span class="nav_name">Pasien</span>
                    </a>
                    <a href="{{ url('/daftarStaff') }}" class="nav_link remove_underline"><i class="fa-sharp fa-solid fa-user-doctor nav-icon"></i>
                        <span class="nav_name">Staff Kesehatan</span>
                    </a>
                    <a href="{{ url('/daftarLayanan') }}" class="nav_link remove_underline"><i class="fa-solid fa-suitcase-medical nav-icon"></i>
                        <span class="nav_name">Layanan</span>
                    </a>
                    <a href="{{ url('/daftarStatus') }}" class="nav_link remove_underline"><i class="fa-solid fa-notes-medical nav-icon"></i>
                        <span class="nav_name">Status Staff</span>
                    </a>
                </div>
            </div>
            <a href="#" class="nav_link remove_underline"><i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <main>
        <div class="">
            {{ $slot }}
        </div>
    </main>
    <!--Container Main end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3996a8b58a.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

</html>