<x-admin-layout :title="'Detail Pesanan'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarPesanan') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan</h3>

            <div class="row mt-5">
                <div class="col-lg-7 col-md-12 shadow-tipis rounded-card py-4 px-4 mx-3">
                    <div class="d-flex">
                        <div class="montserrat-extra color-inti text-start justify-content-start d-inline" style="font-size: larger;">{{ $pesanan->layanan->nama_layanan }}</div>
                        <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_layanan->status }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Harga</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Ongkos</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Tanggal Perawatan</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Jam Perawatan</div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-6">
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; Rp @currency($pesanan->harga)</div>
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; Rp @currency($pesanan->ongkos)</div>
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; {{ $pesanan->getTanggal($pesanan->tanggal_perawatan) }}</div>
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; {{ $pesanan->getJamPerawatan($pesanan->jam_perawatan) }}</div>
                        </div>

                        <!--Awal Buat foto -->

                        <!-- Modal Foto -->
                        <div id="myModals" class="modals">

                            <!-- The Close Button -->
                            <span class="close">&times;</span>

                            <!-- Modal Content (The Image) -->
                            <img class="modals-content" id="img01">

                            <!-- Modal Caption (Image Text) -->
                            <div id="caption"></div>
                        </div>

                        @if($pesanan->foto)
                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 text-center">
                            <img src="{{ asset('storage/'. $pesanan->foto) }}" class="rounded" style="width: fit-content; height: fit-content;" id="myImgs" alt="Foto Luka Pasien" />
                        </div>
                        <!-- HANYA UNTUK TESTING -->
                        @else
                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 text-center">
                            <img src="{{ asset('image/Logo_Klinik_Hitam.png') }}" class="rounded" style="width: fit-content; height: fit-content;" id="myImgs">
                        </div>
                        @endif

                        <!-- Akhir Buat Foto -->
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Keluhan</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Alamat</div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9">

                            <!-- Keluhan -->
                            @if($pesanan->keluhan)
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; {{ $pesanan->keluhan }}</div>
                            @else
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; - </div>
                            @endif

                            <!-- Alamat -->
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 montserrat-extra" id="remove-padding-right" style="margin-top: 14px;">: &nbsp; </div>
                                <div class="col-lg-11 col-md-11 col-sm-11 col-11" id="remove-padding-danger">
                                    <div class="montserrat-extra mt-3" style="font-size: 15px; margin-left: 3px;">{{ $pesanan->alamat }}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <!-- Data Pasien -->
                    <div class="shadow-tipis rounded-card pt-3 pb-1 px-3 mx-2" style="height: 11.2rem;">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                            <a href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-3">Nama</div>
                            </div>
                            <div class="col-9">
                                <div class="montserrat-extra">: &nbsp; {{ $pesanan->user_pasien->NIK }}</div>
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 montserrat-extra" id="remove-padding-right" style="margin-top: 14px;">: &nbsp; </div>
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-11" id="remove-padding-danger">
                                        <div class="montserrat-extra mt-3" style="margin-left: 6px;">{{ $pesanan->user_pasien->nama }}</div>
                                    </div>
                                </div>
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
                            <div class="col-3 mt-4">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-2">Nama</div>
                                <div class="montserrat-bold mt-2">Status</div>
                            </div>
                            <div class="col-9 mt-4">
                                <div class="montserrat-extra">: &nbsp; {{ $pesanan->user_jasa->NIK }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->user_jasa->nama }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $pesanan->status_jasa->status }}</div>
                            </div>
                        </div>
                        @else
                        <div class="montserrat-extra text-danger text-center mt-4">
                            Belum Pilih Tenaga Medis!
                            <br>
                            <button type="button" class="btn btn-primary mt-2" id="btn-pilih" data-bs-toggle="modal" data-bs-target="#modalPilihPerawat">
                                Pilih Tenaga Medis
                            </button>
                        </div>

                        <!-- Modal Pilih Perawat -->
                        <div class="modal fade" id="modalPilihPerawat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title montserrat-extra" id="exampleModalLabel">Pilih Tenaga Medis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('pesan/updatePerawat/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                                        @method("PATCH")
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="NIK_jasa">Tenaga Medis</label>

                                                <select class="form-control select2 mt-2" name="id_jasa" id="id_jasa">
                                                    <option disabled value>Pilih NIK jasa</option>

                                                    @foreach($nikJasa as $item)
                                                    <option value="{{ $item->id }}" @if ($item->NIK == $pesanan->NIK_jasa)
                                                        selected="selected"
                                                        @endif
                                                        > {{ $item->nama }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4 mb-4">
                                            <div class="col-md-6 text-center">
                                                <!-- Buttton Cancel -->
                                                <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <!-- Button Pilih -->
                                                <button type="submit" class="btn btn-primary" id="btn-konfirmasi-sedang">Pilih</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal Alert Belum ada id_jasa saat konfirmasi -->
            <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content shadow-tipis">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa-solid fa-triangle-exclamation" style="color: #FE8880; font-size: 70px;"></i>
                            </div>
                            <div class="text-center montserrat-extra mt-3">Warning</div>
                            <div class="text-center montserrat-bold mt-4 color-abu">Gagal Konfirmasi! <br>Silahkan pilih perawat terlebih dahulu</div>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Pesanan -->
            <form action="{{ url('detailPesanan/konfirm/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

                <div class="modal fade" id="modalKonfirmasiPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-tipis">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="fa-solid fa-right-from-bracket" style="color: #3E82E4; font-size: 70px;"></i>
                                </div>
                                <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Konfirmasi Pesanan</div>
                                <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin mengkonfirmasi pesanan ini?
                                    <br>Pastikan semua data sudah terisi dengan benar.
                                </div>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-6 text-center">
                                    <!-- Buttton Cancel -->
                                    <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <!-- Button Konfirmasi Pesanan -->
                                    <button type="submit" class="btn btn-primary" id="btn-konfirmasi">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="mt-5 me-5 d-flex">

                <div class="text-start d-inline me-auto">
                    <!-- Button Edit hanya muncul untuk status selain Selesai dan Dibatalkan -->
                    @if($pesanan->status_layanan->status != "Selesai" || $pesanan->status_layanan->status != "Dibatalkan")
                    <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="btn-edit">Edit</a>
                    @endif
                </div>

                <div class="text-end d-inline ms-auto">
                    @if($pesanan->status_layanan->status == "Menunggu")
                        @if($pesanan->id_jasa)
                        <button type="button" class="btn btn-success me-5 ms-3" id="btn-konfirmasi" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiPesanan">
                            Konfirmasi
                        </button>
                        @else
                        <button type="button" class="btn btn-success me-5 ms-3" id="btn-konfirmasi" data-bs-toggle="modal" data-bs-target="#modalAlert">
                            Konfirmasi
                        </button>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>