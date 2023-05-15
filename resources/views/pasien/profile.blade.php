<x-inti-layout :title="'Profile'">

    <div class="container">

        <a href="https://wa.me/628117830717" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-5">

                    <div class="d-flex">
                        <div class="ms-auto mt-auto justify-content-end d-inline ps-5" style="overflow: hidden;">
                            @if (session()->has('info'))
                            <div class="custom-alert align-items-end">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="msg">{{ session()->get('info') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="d-inline mt-4 mb-3">
                            <!-- Header -->
                            <a href="{{ url('/home') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                            <h3 class="d-inline montserrat-extra text-start">Profile</h3>
                        </div>
                    </div>

                    <div class="row shadow-tipis rounded-card mt-5 px-2">
                        <!-- Nama samo NIK -->
                        <div class="col-lg-4 p-5 text-center border-end">
                            @if($user->jenis_kelamin == "L")
                            <img src="{{ asset('image/man_avatar.png') }}" alt="Avatar Pasien" class="rounded-circle mx-auto" width="100" height="100">
                            @else
                            <img src="{{ asset('image/woman_avatar.png') }}" alt="Avatar Pasien" class="rounded-circle mx-auto" width="100" height="100">
                            @endif
                            <div class="montserrat-extra mt-4">{{ $user->nama }}</div>
                            <div class="montserrat-bold mt-3 font-smaller">{{ $user->NIK }}</div>
                        </div>

                        <!-- Semua data selain nama dan NIK -->
                        <div class="col-lg-8 py-4 px-2">

                            <div class="row pb-4 px-3 border-bottom">
                                <div class="col-lg-4">
                                    <div class="montserrat-bold color-abu-tuo font-smaller">
                                        Jenis Kelamin : &nbsp; <span class="montserrat-extra color-abu">{{ $user->getJenisKelamin($user->jenis_kelamin) }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="montserrat-bold color-abu-tuo font-smaller">
                                        Tanggal Lahir : &nbsp; <span class="montserrat-extra color-abu">{{ $user->getTanggal($user->tanggal_lahir) }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="montserrat-bold color-abu-tuo font-smaller">
                                        Umur : &nbsp;
                                        @if($user->getUmur($user->tanggal_lahir) != 0)
                                        <span class="montserrat-extra color-abu">{{ $user->getUmur($user->tanggal_lahir) }} Tahun</span>
                                        @elseif($user->getUmur_bulan($user->tanggal_lahir) != 0)
                                        <span class="montserrat-extra color-abu">{{ $user->getUmur_bulan($user->tanggal_lahir) }} bulan</span>
                                        @else
                                        <span class="montserrat-extra color-abu">{{ $user->getUmur_hari($user->tanggal_lahir) }} hari</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-4 pb-4 px-3 border-bottom">
                                <div class="col-lg-4">
                                    <div class="montserrat-bold color-abu-tuo font-smaller">
                                        Email : &nbsp; <span class="montserrat-extra color-abu">{{ $user->email }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="montserrat-bold color-abu-tuo font-smaller">
                                        Nomor Telepon : &nbsp; <span class="montserrat-extra color-abu">+{{ $user->phoneNumber($user->notelp) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-4 pb-3 px-3">

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="montserrat-bold color-abu-tuo font-smaller">
                                            <td>Alamat : &nbsp;</td>
                                            <td>
                                                @if(!empty($alamat[0]))
                                                <div class="montserrat-extra color-abu">Silahkan lihat alamat yang terdaftar di Daftar Alamat Saya</div>
                                                <a href="/profile/alamat" class="btn btn-success mt-3" id="pesan-btn">Daftar Alamat Saya</a>
                                                @else
                                                <div class="montserrat-extra text-danger">Belum ada alamat yang terdaftar. Silahkan tambah alamat!</div>
                                                <a href="/profile/alamat/addView" class="btn btn-success mt-3" id="pesan-btn">Tambah Alamat</a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end ms-auto">
                        <a href="{{ url('profile/editProfile') }}" class="btn btn-success mt-4" id="btn-edit">Edit</a>
                    </div>

                    <h3 class="montserrat-extra mt-5">Riwayat pemesanan</h3>

                    <div class="row my-4">
                        @foreach($pesanan as $item)
                        <div class="col-lg-3 col-md-4 col-sm-12 col-12 mb-5">
                            <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="">

                                <div class="status_chip text-center">{{ $item->status_pesanan->status }}</div>
                                <div class="card-body">
                                    <div class="montserrat-bold text-start mt-2 color-abu-tuo" style="font-size: 12px;">Layanan </div>
                                    <div class="montserrat-extra text-start mt-1 font-smaller"> {{ $item->layanan->nama_layanan  }} </div>
                                    <div class="montserrat-bold text-start mt-3 color-abu-tuo" style="font-size: 12px;">Tenaga Medis </div>
                                    <div class="montserrat-extra text-start mt-1 font-smaller"> {{ $item->status_jasa->status  }} </div>
                                </div>

                                <div class="d-flex mt-3">
                                    @if($item->id_status_pesanan == "M")
                                    <a type="button" class="btn btn-success mt-2 mb-2 ms-3 d-inline me-auto" id="btn-tolak-kecil" data-bs-toggle="modal" data-bs-target="#modalBatalPesanan">
                                        Batalkan
                                    </a>
                                    <!-- Modal Batal Pesanan -->
                                    <form action="{{ url('/batalPesanan/'.$item->id) }}" method="post" enctype="multipart/form-data">
                                        @method("PATCH")
                                        @csrf

                                        <div class="modal fade" id="modalBatalPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content shadow-tipis">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body px-5">
                                                        <div class="text-center">
                                                            <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
                                                        </div>
                                                        <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Batalkan Pesanan</div>
                                                        <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin membatalkan pesanan ini?
                                                            <br>Pastikan terlebih dahulu sebelum membatalkan pesanan ini!
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <div class="col-6 text-center">
                                                            <!-- Buttton Cancel -->
                                                            <button type="button" class="btn btn-secondary px-md-4 py-md-2 px-3 py-2" id="btn-cancel-sedang-pasien" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <!-- Button Konfirmasi Pesanan -->
                                                            <button type="submit" class="btn btn-primary px-md-4 py-md-2 px-3 py-2" id="btn-tolak-pasien">Batalkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    @endif
                                    <a type="button" href="{{ url('/detailPesananPasien/'.$item->id) }}" class="btn btn-primary my-1 d-inline ms-auto ms-3 py-2 px-3" id="pesan-btn">Lihat</a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-inti-layout>
<link rel="stylesheet" href="{{ asset('css/notification.css') }}">
<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">

<script>
    $(document).ready(function() {
        $('.custom-alert').addClass("show");
        $('.custom-alert').removeClass("hide");
        $('.custom-alert').addClass("showAlert");
        setTimeout(function() {
            $('.custom-alert').removeClass("show");
            $('.custom-alert').addClass("hide");
        }, 4000);
    });
    $('.close-btn').click(function() {
        $('.custom-alert').removeClass("show");
        $('.custom-alert').addClass("hide");
    });
</script>