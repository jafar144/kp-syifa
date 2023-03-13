<x-admin-layout>

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarPesanan') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan</h3>

            <div class="row mt-5">
                <div class="col-lg-7 shadow-tipis rounded-card py-4 px-4 mx-3">
                    <div class="d-flex">
                        <div class="montserrat-extra color-inti text-start justify-content-start d-inline" style="font-size: larger;">{{ $pesanan->layanan->nama_layanan }}</div>
                        <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_layanan->status }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3">
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Harga</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Ongkos</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Tanggal Perawatan</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Jam Perawatan</div>
                        </div>
                        <div class="col-lg-5">
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
                        <div class="col-lg-4 text-center">
                            <img src="{{ asset('storage/'. $pesanan->foto) }}" class="rounded" style="width: fit-content; height: fit-content;" id="myImgs" alt="Foto Luka Pasien" />
                        </div>
                        <!-- HANYA UNTUK TESTING -->
                        @else
                        <div class="col-lg-4 text-center">
                            <img src="{{ asset('image/Logo_Klinik_Hitam.png') }}" class="rounded" style="width: fit-content; height: fit-content;" id="myImgs">
                        </div>
                        @endif

                        <!-- Akhir Buat Foto -->

                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3">
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Keluhan</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Alamat</div>
                        </div>
                        <div class="col-lg-9">
                            <!-- Keluhan -->
                            @if($pesanan->keluhan)
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; {{ $pesanan->keluhan }}</div>
                            @else
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; - </div>
                            @endif

                            <!-- Alamat -->
                            <div class="montserrat-extra mt-3" style="font-size: 15px;">: &nbsp; {{ $pesanan->alamat }}</div>
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
                        <div class="montserrat-bold text-danger text-center mt-4">
                            Belum Pilih Perawat!
                            <br>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPilihPerawat">
                                Pilih Perawat
                            </button>
                        </div>

                        <!-- Modal Pilih Perawat -->
                        <div class="modal fade" id="modalPilihPerawat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pilih Perawat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('pesan/updatePerawat/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                                        @method("PATCH")
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="NIK_jasa">NIK </label>

                                                <select class="form-control select2" name="id_jasa" id="id_jasa">
                                                    <option disabled value>Pilih NIK jasa</option>

                                                    @foreach($nikJasa as $item)
                                                    <option value="{{ $item->id }}" @if ($item->NIK == $pesanan->NIK_jasa)
                                                        selected="selected"
                                                        @endif
                                                        > {{ $item->nama }} ; {{ $item->NIK }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
            <div class="text-end mt-5 me-5">

                <form action="{{ url('detailPesanan/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                    @method("PATCH")
                    @csrf

                    <!-- Cek kalau status pesanannya ....  -->
                    @if($pesanan->status_layanan->status != "Selesai")
                    <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="btn-edit">Edit</a>
                    @endif

                    @if($pesanan->id_jasa)
                    <button type="submit" class="btn btn-success me-5 ms-3" id="btn-konfirmasi">Konfirmasi</button>
                    @else
                    <button type="button" class="btn btn-success me-5 ms-3" id="btn-konfirmasi" data-bs-toggle="modal" data-bs-target="#modalAlert">
                        Konfirmasi
                    </button>
                    @endif
                </form>
                
            </div>
        </div>
    </div>

</x-admin-layout>