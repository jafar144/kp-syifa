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
                <div class="col-lg-4 shadow-tipis rounded-card py-3 px-4 mx-3" style="height: 11.2rem;">
                    <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                    <!-- Data Pasien -->
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
                    <div class="my-1 text-end">
                        <a href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" target="_blank" rel="noopener">
                            <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                        </a>
                    </div>
                    <!-- Data Tenaga Medis -->
                    <div class="row shadow-tipis rounded-card py-3 px-3 mt-5" style="width: fit-content;">
                        <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Medis</div>
                        <div class="col-lg-3">
                            <div class="montserrat-bold">NIK</div>
                            <div class="montserrat-bold mt-2">Nama</div>
                            <div class="montserrat-bold mt-2">status</div>
                        </div>
                        <div class="col-lg-9">
                            <div class="montserrat-extra">: &nbsp; {{ $pesanan->user_jasa->NIK }}</div>
                            <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->user_jasa->nama }}</div>
                            <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->status_jasa->status }}</div>
                        </div>
                    </div>
                    <div class="my-1 text-end">
                        <a href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" target="_blank" rel="noopener">
                            <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="pesan-btn">Edit</a>
            <h2>BIODATA MEDIS</h2>
            @if($pesanan->id_jasa)
            status medis = {{ $pesanan->status_jasa->status }} <br>
            notelp = {{ $pesanan->user_jasa->notelp }} <br>
            @else
            silahkan pilih staff medis untuk melayani pesanan
            @endif
            @if($pesanan->foto)
            {{ $pesanan->foto }}<br>
            @endif
        </div>
    </div>

</x-admin-layout>