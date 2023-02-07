<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-inti py-3 shadow">
    <div class="container">
        <span class="navbar-brand brand-text mb-0 h1 text-white">GetMaterial</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-auto">
                <li class="nav-item mx-1 {{ Request::segment(1) === 'home' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'daftarBarang' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('/daftarBarang') }}">Barang</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'daftarSales' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('/daftarSales') }}">Sales</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'headerPenjualan' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('/headerPenjualan') }}">Transaksi</a>
                </li>
                <li class="nav-item mx-1 {{ Request::segment(1) === 'detailPenjualan' ? 'text-nav-active' : 'text-nav' }}">
                    <a class="nav-link text-white" href="{{ url('/detailPenjualan') }}">Detail Transaksi</a>
                </li>
            </ul>
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center montserrat-bold font-medium text-white hover:border-white-300 focus:outline-none focus:text-white-700 focus:border-white-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }} &nbsp;| &nbsp;{{ Auth::user()->jabatan }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="flex items-center space-x-4 sm:-my-px sm:ml-10 sm:flex">
                <a href="{{ url('/login') }}">
                    <div class="btn btn-light me-3" id="login-text">Login</div>
                </a>
                <a href="{{ url('/register') }}">
                    <div class="btn btn-outline-light" id="register-text">Register</div>
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>