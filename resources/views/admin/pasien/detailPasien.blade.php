<x-admin-layout :title="'Detail Pasien'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarPasien') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pasien</h3>
            <!-- Data Pasien -->
            <div class="row mt-5">
                <div class="col-lg-5 ">
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                            <a href="https://wa.me/{{ $pasien->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-2">Nama</div>
                                <div class="montserrat-bold mt-2">Jenis Kelamin</div>
                                <div class="montserrat-bold mt-2">Email</div>
                                <div class="montserrat-bold mt-2">Tanggal Lahir</div>
                                <div class="montserrat-bold mt-2">Umur</div>
                                <div class="montserrat-bold mt-2">Alamat</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="montserrat-extra">: &nbsp; {{ $pasien->NIK }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->nama }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->getJenisKelamin($pasien->jenis_kelamin) }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->email }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->getTanggal($pasien->tanggal_lahir) }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->getUmur($pasien->tanggal_lahir) }} tahun</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pasien->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-admin-layout>