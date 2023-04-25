<x-admin-layout :title="'Detail Pasien'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarPasien') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pasien</h3>

            <!-- Data Pasien -->
            <div class="row mt-5">
                <div class="col-lg-7">
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                            <a href="https://wa.me/{{ $pasien->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <table class="table table-borderless mt-3">
                                    <tbody>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>NIK</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->NIK }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Nama</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->nama }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Jenis&nbsp;Kelamin</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->getJenisKelamin($pasien->jenis_kelamin) }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Email</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->email }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Tanggal&nbsp;Lahir</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->getTanggal($pasien->tanggal_lahir) }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Umur</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->getUmur($pasien->tanggal_lahir) }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div>Alamat</div>
                                            </td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pasien->alamat }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-admin-layout>