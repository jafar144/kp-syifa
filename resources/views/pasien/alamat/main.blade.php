<x-inti-layout :title="'Daftar Alamat'">

    <div class="container">

        <a href="https://wa.me/" class="wa-float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-5 px-4">

                    @if (session()->has('info'))
                    <div class="alert alert-success">
                        {{ session()->get('info') }}
                    </div>
                    @endif

                    <a href="{{ url('/profile') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">Daftar Alamat Saya</h3>

                    <div class="row mt-5">
                        @foreach($alamat as $item)
                        <div class="col-md-4 col-12">
                            <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda">
                                <a href="{{ url('/profile/alamat/updateView/'.$item->id) }}" class="remove-underline">
                                    <div class="montserrat-extra font-smaller">{{ $item->alamat }}</div>
                                    <div class="montserrat-bold color-abu-muda font-smaller">{{ $item->detail }}</div>
                                    <div class="montserrat-bold font-smaller mt-4">Jarak Alamat ke Klinik : {{ $item->jarak }} meter</div>
                                </a>
                                <div class="mt-3">
                                    <a type="button" class="btn btn-success mt-2 mb-2" id="btn-tolak-kecil" data-bs-toggle="modal" data-bs-target="#modalHapusAlamat">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Batal Pesanan -->
                        <form action="{{ url('/profile/alamat/delete/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('delete')

                            <div class="modal fade" id="modalHapusAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content shadow-tipis">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body px-5">
                                            <div class="text-center">
                                                <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
                                            </div>
                                            <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Hapus Alamat</div>
                                            <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin menghapus alamat ini?</div>
                                        </div>
                                        <div class="row mt-4 mb-4">
                                            <div class="col-md-6 text-center">
                                                <!-- Buttton Cancel -->
                                                <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <!-- Button Hapus Alamat -->
                                                <button type="submit" class="btn btn-primary" id="btn-tolak">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @endforeach
                    </div>
                    <div>
                        <a href="{{ url('/profile/alamat/addView') }}" class="btn btn-primary me-5 mt-4" id="pesan-btn-sedang">
                            <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Alamat
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-inti-layout>

<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">