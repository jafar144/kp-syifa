<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-inti py-3 shadow">
    <div class="container">
        <div class="py-2">
            <a class="navbar-brand" href="{{ url('/homePasien') }}">
                <img src="{{ asset('image/Logo_Klinik_Hitam.png') }}" alt="Logo Klinik" width="35" height="35" class="d-inline-block pb-2">
                <div class="brand-text h4 text-white d-inline-block mb-0 mt-1 ms-2">Home Care Klinik Al-Syifa</div>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-1 {{ Request::segment(1) === 'home' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" aria-current="page" href="{{ url('/home') }}">Layanan</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'daftarBarang' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('profile') }}">Profile</a>
                </li>
                <div class="dropdown nav-item">
                    <button class="btn dropdown-toggle montserrat-bold text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->nama }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('profile') }}">Profil</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</nav>