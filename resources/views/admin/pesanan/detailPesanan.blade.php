<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <!-- Header -->
            <a href="{{ url('/home') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan</h3>

            <div class="row mt-5">
                <div class="col-lg-7 shadow-tipis rounded-card py-3 px-4 mx-3">
                    <div class="d-flex">
                        <div class="montserrat-extra text-start justify-content-start d-inline">{{ $pesanan->layanan->nama_layanan }}</div>
                        <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_layanan->status }}</div>
                    </div>
                </div>
                <div class="col-lg-4 shadow-tipis rounded-card py-3 px-4 mx-3">
                    <div class="montserrat-extra text-start">Data Pasien</div>
                    <div class="row mt-4">
                        <div class="col-lg-3">
                            <div class="montserrat-bold">NIK &nbsp; &nbsp; &nbsp; &nbsp; :</div>
                            <div class="montserrat-bold mt-3">Nama &nbsp; &nbsp;:</div>
                        </div>
                        <div class="col-lg-9">
                            <div class="montserrat-extra">{{ $pesanan->user_pasien->NIK }}</div>
                            <div class="montserrat-extra mt-3">{{ $pesanan->user_pasien->nama }}</div>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a 
                            href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" 
                            target="_blank" 
                            rel="noopener">
                            <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="pesan-btn">Edit</a>
            <h2>BIODATA PASIEN</h2>
            nik = {{ $pesanan->user_pasien->NIK }} <br>
            nama = {{ $pesanan->user_pasien->nama }} <br>
            notelp = {{ $pesanan->user_pasien->notelp }} <br>
            <hr>
            <h2>BIODATA MEDIS</h2>
            @if($pesanan->id_jasa)
            status medis = {{ $pesanan->status_jasa->status }} <br>
            nik = {{ $pesanan->user_jasa->NIK }} <br>
            nama = {{ $pesanan->user_jasa->nama }} <br>
            notelp = {{ $pesanan->user_jasa->notelp }} <br>
            @else
            silahkan pilih staff medis untuk melayani pesanan
            @endif
            <hr>
            <h2>PESANAN</h2>
            {{ $pesanan->layanan->nama_layanan }} <br>
            harga = {{ $pesanan->harga }} <br>
            ongkos = {{ $pesanan->ongkos }} <br>
            @if($pesanan->keluhan)
            keluhan = {{ $pesanan->keluhan }}<br>
            @endif
            @if($pesanan->foto)
            {{ $pesanan->foto }}<br>
            @endif
            jadwal : {{ $pesanan->tanggal_perawatan }} , jam = {{ $pesanan->jam_perawatan }} <br>
            alamat : {{ $pesanan->alamat }}

            <hr />
        </div>
    </div>

</x-admin-layout>