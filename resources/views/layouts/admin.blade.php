@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? "" }}</title>
    <!-- Logo Website -->
    <link rel="icon" type="image/x-icon" href="{{ asset('image/Logo_Kliniks.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sideBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/status.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalImage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://kit.fontawesome.com/3996a8b58a.css" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <script src="{{ asset('js/statusChip.js') }}"></script>
    <script src="{{ asset('js/modalImage.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3996a8b58a.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- DataTable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
</head>

<!-- How to Hide Sidebar First -->
<!-- Hapus semua class "body-pd", hapus "bx-x", hapus "show" sebelah l-navbar -->

<body id="body-pd" class="body-pd">
    <header class="header body-pd" id="header" style="background-color: transparent;">
        <div class="header_toggle"> <i class='bx bx-menu bx-x' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="{{ url('/daftarPesanan') }}" class="nav_logo remove_underline mt-3">
                    <img src="{{ asset('image/Logo_Kliniks.png') }}" alt="Logo Klinik" width="27" height="27">
                    <span class="nav_logo-name">Syifa</span>
                </a>
                <div class="nav_list">
                    <a href="{{ url('/daftarPesanan') }}" class="nav_link remove_underline {{ Request::segment(1) === 'daftarPesanan' ? 'active' : '' }}"><i class="fa-regular fa-file-lines nav_icon"></i>
                        <span class="nav_name">Pesanan</span>
                    </a>
                    <a href="{{ url('/daftarLayanan') }}" class="nav_link remove_underline {{ Request::segment(1) === 'daftarLayanan' ? 'active' : '' }}"><i class="fa-solid fa-suitcase-medical nav-icon"></i>
                        <span class="nav_name">Layanan</span>
                    </a>
                    <a href="{{ url('/daftarStaff') }}" class="nav_link remove_underline {{ Request::segment(1) === 'daftarStaff' ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-user-doctor nav-icon"></i>
                        <span class="nav_name">Staff Medis</span>
                    </a>
                    <a href="{{ url('/daftarStatusStaff') }}" class="nav_link remove_underline {{ Request::segment(1) === 'daftarStatusStaff' ? 'active' : '' }}"><i class="fa-solid fa-notes-medical nav-icon"></i>
                        <span class="nav_name">Status Staff</span>
                    </a>
                    <a href="{{ url('/daftarPasien') }}" class="nav_link remove_underline {{ Request::segment(1) === 'daftarPasien' ? 'active' : '' }}"><i class="fa-solid fa-user nav-icon"></i>
                        <span class="nav_name">Pasien</span>
                    </a>
                </div>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiLogout" class="nav_link remove_underline">
                <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
            </button>
        </nav>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalKonfirmasiLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow-tipis">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa-solid fa-right-from-bracket" style="color: #3E82E4; font-size: 70px;"></i>
                    </div>
                    <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Logout</div>
                    <div class="text-center montserrat-bold mt-4 color-abu">Yakin mau keluar? <br></div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-md-6 text-center">
                        <!-- Buttton Cancel -->
                        <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-md-6 text-center">
                        <!-- Button Konfirmasi logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary" onclick="event.preventDefault();this.closest('form').submit();" id="btn-konfirmasi-sedang">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Container Main start-->
    <main>
        <div class="">
            {{ $slot }}
        </div>
    </main>
    <!--Container Main end-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

</html>