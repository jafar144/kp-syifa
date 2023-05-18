<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">
<x-guest-layout :title="'Lupa Password'">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password kamu? Silahkan masukkan email kamu di bawah dan kami akan mengirim link untuk reset password lewat email tersebut.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email (yang terdaftar)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Submit Email') }}
            </x-primary-button>
        </div>
        <div class="mt-4">
            <div class="text-sm text-red-600 mb-4">Jika tidak memiliki email yang terdaftar, silahkan hubungi admin untuk mengganti password akun saya</div>
            <a href="https://wa.me/628117830717" class="btn btn-success" id="custom-wa-button" target="_blank" rel="noopener">
                <i class="fa fa-whatsapp fa-xl" aria-hidden="true"></i> &nbsp; Hubungi Kami
            </a>
        </div>
    </form>
</x-guest-layout>
<script src="https://kit.fontawesome.com/3996a8b58a.js" crossorigin="anonymous"></script>