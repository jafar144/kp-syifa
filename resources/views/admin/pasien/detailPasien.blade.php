<x-admin-layout :title="'Detail Pasien'">

    <div class="container">
        <div class="py-5">

            <div class="d-flex">
                <div class="d-inline mt-4 mb-3">
                    <!-- Header -->
                    <a href="{{ url('/daftarPasien') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pasien</h3>
                </div>
                <div class="ms-auto mt-auto justify-content-end d-inline ps-5" style="overflow: hidden;">
                    @if (session()->has('info'))
                    <div class="custom-alert align-items-end">
                        <div class="row">
                            <div class="col-2">
                                <span class="fas fa-exclamation-circle"></span>
                            </div>
                            <div class="col-8">
                                <span class="msg">{{ session()->get('info') }}</span>
                            </div>
                            <div class="col-2">
                                <div class="close-btn">
                                    <span class="fas fa-times"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

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
                                            @if($pasien->getUmur($pasien->tanggal_lahir) != 0)
                                            <td class="montserrat-extra color-abu">{{ $pasien->getUmur($pasien->tanggal_lahir) }} tahun</td>
                                            @elseif($pasien->getUmur_bulan($pasien->tanggal_lahir) != 0)
                                            <td class="montserrat-extra color-abu">{{ $pasien->getUmur_bulan($pasien->tanggal_lahir) }} bulan</td>
                                            @else
                                            <td class="montserrat-extra color-abu">{{ $pasien->getUmur_hari($pasien->tanggal_lahir) }} hari</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/daftarPasien/updateView/'.$pasien->id) }}" class="btn btn-success mt-4 ms-3" id="btn-edit-kecil">Edit</a>
        </div>
    </div>

</x-admin-layout>

<script>
    $(document).ready(function() {
        $('.custom-alert').addClass("show");
        $('.custom-alert').removeClass("hide");
        $('.custom-alert').addClass("showAlert");
        setTimeout(function() {
            $('.custom-alert').removeClass("show");
            $('.custom-alert').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.custom-alert').removeClass("show");
        $('.custom-alert').addClass("hide");
    });
</script>