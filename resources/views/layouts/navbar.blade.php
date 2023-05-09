<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-inti py-3 shadow">
    <div class="container">
        <div class="py-2">
            <a class="navbar-brand px-3 px-md-0" href="{{ url('/home') }}">
                <img src="{{ asset('image/Logo_Kliniks.png') }}" alt="Logo Klinik" width="35" height="35" class="d-inline-block pb-2">
                <div class="brand-text h4 text-white d-none d-md-inline-block mb-0 mt-1 ms-2">Home Care Klinik Al-Syifa</div>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-1 {{ Request::segment(1) === 'home' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" aria-current="page" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'profile' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('profile') }}">Profile</a>
                </li>
                <div class="dropdown nav-item">
                    <button class="btn dropdown-toggle montserrat-bold text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->getFirstName(Auth::user()->nama) }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
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
<style>
    .navbar-toggler .navbar-toggler-icon {
        width: 25px !important;
        height: 25px !important;
    }

    .navbar-toggler{
        border: none;
    }
</style>