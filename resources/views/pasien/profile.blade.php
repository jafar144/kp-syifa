<x-inti-layout :title="'Profile'">

    <div class="container">

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-5">

                    <div class="row shadow-tipis rounded-card">
                        <!-- Nama samo NIK -->
                        <div class="col-lg-4 p-5 text-center border-end">
                            <img src="" alt="Avatar Pasien" class="rounded-circle">
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
                                        Umur : &nbsp; <span class="montserrat-extra color-abu">{{ $user->getUmur($user->tanggal_lahir) }} Tahun</span>
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
                                            <td class="montserrat-extra color-abu">{{ $user->alamat }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <a href="{{ url('profile/editProfile') }}">edit profile</a>

                    <h2 class="montserrat-bold">Riwayat pemesanan</h2>

                    <div class="row my-4">
                        @foreach($pesanan as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                            <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="" style="height: 14rem;">

                                @if($item->id_status_layanan == "M")
                                    <a href="{{ url('/batalPesanan/'.$item->id) }}">BATALKAN</a><br>
                                @endif
                                layanan = {{ $item->layanan->nama_layanan  }} <br>
                                jasa = {{ $item->status_jasa->status  }} <br>
                                status = {{ $item->status_layanan->status  }} <br>

                                <a href="{{ url('/detailPesanan/'.$item->id) }}">Detail</a><br>

                            </div>
                        </div>
                        @endforeach
                    </div>



                </div>
            </div>
        </div>

    </div>

</x-inti-layout>