<x-inti-layout :title="'Profile'">

    <div class="container">

        <a href="https://wa.me/" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-5">

                    <a href="{{ url('/home') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">Profile</h3>

                    <div class="row shadow-tipis rounded-card mt-5">
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
                                            <td class="montserrat-extra color-abu">
                                                @if(empty($alamat[0]))
                                                <a href="/profile/alamat/addView">tambah alamat</a>
                                                @else
                                                <a href="/profile/alamat">klik here for detail</a>
                                                <ul>
                                                    @foreach($alamat as $item)
                                                    <li>{{$item->alamat}} , jarak = {{$item->jarak}}km</li>
                                                    @endforeach
                                                </ul>
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
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                            <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="">

                                <div class="status_chip text-center">{{ $item->status_layanan->status }}</div>
                                <div class="card-body">
                                    <div class="montserrat-bold text-start mt-2 color-abu-tuo" style="font-size: 12px;">Layanan </div>
                                    <div class="montserrat-extra text-start mt-1 font-smaller"> {{ $item->layanan->nama_layanan  }} </div>
                                    <div class="montserrat-bold text-start mt-3 color-abu-tuo" style="font-size: 12px;">Tenaga Medis </div>
                                    <div class="montserrat-extra text-start mt-1 font-smaller"> {{ $item->status_jasa->status  }} </div>
                                </div>

                                <div class="d-md-flex mt-3">
                                    @if($item->id_status_layanan == "M")
                                    <a type="button" class="btn btn-success mt-2 mb-2 ms-3 d-md-inline me-md-auto" id="btn-tolak-kecil" data-bs-toggle="modal" data-bs-target="#modalBatalPesanan">
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
                                                        <div class="col-md-6 text-center">
                                                            <!-- Buttton Cancel -->
                                                            <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <!-- Button Konfirmasi Pesanan -->
                                                            <button type="submit" class="btn btn-primary" id="btn-tolak">Batalkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    @endif
                                    <a type="button" href="{{ url('/detailPesananPasien/'.$item->id) }}" class="btn btn-primary my-1 d-md-inline ms-md-auto ms-3 py-2 px-3" id="pesan-btn">Lihat</a>
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
<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">