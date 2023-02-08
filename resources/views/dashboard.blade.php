<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('statususer.main') }}">Daftar Status User</a>
        <br>
        <a href="{{ route('layanan.main') }}">Daftar Layanan</a>
        <br>
        <a href="{{ route('statuslayanan.main') }}">Daftar Status Layanan</a>
        <br>
        <a href="{{ route('hargalayanan.main') }}">Daftar Harga Layanan</a>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
