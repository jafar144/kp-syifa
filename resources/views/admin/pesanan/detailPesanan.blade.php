<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <!-- Header -->
            <a href="{{ url('/home') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan</h3>

            <div class="row mt-5">
                <div class="col-lg-7 shadow-tipis rounded-card py-4 px-4 mx-3">
                    <div class="d-flex">
                        <div class="montserrat-extra color-inti text-start justify-content-start d-inline" style="font-size: larger;">{{ $pesanan->layanan->nama_layanan }}</div>
                        <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_layanan->status }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3">
                            <div class="montserrat-bold mt-3">Harga</div>
                            <div class="montserrat-bold mt-3">Ongkos</div>
                            <div class="montserrat-bold mt-3">Tanggal Perawatan</div>
                            <div class="montserrat-bold mt-3">Jam Perawatan</div>
                        </div>
                        <div class="col-lg-5">
                            <div class="montserrat-extra mt-3">: &nbsp; Rp @currency($pesanan->harga)</div>
                            <div class="montserrat-extra mt-3">: &nbsp; Rp @currency($pesanan->ongkos)</div>
                            <div class="montserrat-extra mt-3">: &nbsp; {{ $pesanan->tanggal_perawatan }}</div>
                            <div class="montserrat-extra mt-3">: &nbsp; {{ $pesanan->jam_perawatan }}</div>
                        </div>

                        <!-- Buat foto -->
                        @if($pesanan->foto)
                        <div class="col-lg-4 text-center">
                            <img src="{{asset('storage/'. $pesanan->foto)}}" class="rounded" style="width: auto; height: auto;" alt="Foto Luka Pasien" />
                        </div>
                        <!-- HANYA UNTUK TESTING -->
                        @else
                        <div class="col-lg-4 text-center">
                            <img src="{{ asset('image/Logo_Klinik_Hitam.png') }}" class="rounded" style="width: fit-content; height: fit-content;" alt="Tes Gambar">
                        </div>
                        @endif

                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3">
                            <div class="montserrat-bold mt-3">Keluhan</div>
                            <div class="montserrat-bold mt-3">Alamat</div>
                        </div>
                        <div class="col-lg-9">
                            <!-- Keluhan -->
                            @if($pesanan->keluhan)
                            <div class="montserrat-extra mt-3">: &nbsp; {{ $pesanan->keluhan }}</div>
                            @else
                            <div class="montserrat-extra mt-3">: &nbsp; - </div>
                            @endif

                            <!-- Alamat -->
                            <div class="montserrat-extra mt-3">: &nbsp; {{ $pesanan->alamat }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <!-- Data Pasien -->
                    <div class="shadow-tipis rounded-card pt-3 pb-1 px-3 mx-2" style="height: 11.2rem;">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                            <a href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-2">Nama</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="montserrat-extra">: &nbsp; {{ $pesanan->user_pasien->NIK }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->user_pasien->nama }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Data Tenaga Medis -->
                    <div class="shadow-tipis rounded-card py-3 px-3 mx-2 mt-4" style="height: 12rem;">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Medis</div>
                            @if($pesanan->id_jasa)
                            <a href="https://wa.me/{{ $pesanan->status_jasa->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                            @endif
                        </div>
                        @if($pesanan->id_jasa)
                        <div class="row">
                            <div class="col-lg-3 mt-4">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-2">Nama</div>
                                <div class="montserrat-bold mt-2">Status</div>
                            </div>
                            <div class="col-lg-9 mt-4">
                                <div class="montserrat-extra">: &nbsp; {{ $pesanan->user_jasa->NIK }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->user_jasa->nama }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->status_jasa->status }}</div>
                            </div>
                        </div>
                        @else
                            <div class="montserrat-bold text-danger text-center mt-4">Belum Pilih Perawat!<br>Silahkan Pilih Perawat di <span class="montserrat-extra">MENU EDIT</span></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-end mt-5 me-5">
                <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="btn-edit">Edit</a>
                <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success me-5 ms-3" id="btn-konfirmasi">Konfirmasi</a>
            </div>
        </div>
    </div>

</x-admin-layout>