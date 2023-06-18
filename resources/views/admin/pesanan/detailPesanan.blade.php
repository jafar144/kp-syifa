<x-admin-layout :title="'Detail Pesanan'">

    <div class="container">
        <div class="py-5">

            <div class="d-flex">
                <div class="d-inline mt-4 mb-3">
                    <!-- Header -->
                    <a href="{{ url('/daftarPesanan') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan</h3>
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

            <div class="row mt-5">
                <div class="col-lg-7 col-md-12 shadow-tipis rounded-card py-4 px-4 mx-3">
                    <div class="d-flex">
                        <div class="montserrat-extra color-inti text-start justify-content-start d-inline" style="font-size: larger;">{{ $pesanan->layanan->nama_layanan }}</div>
                        <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_pesanan->status }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Harga</div>
                            <div class="montserrat-bold mt-3" style="font-size: 15px;">Ongkos</div>
                            <div class="montserrat-bold mt-3 nama_panjang" style="font-size: 15px;">Tanggal Perawatan</div>
                            <div class="montserrat-bold mt-3 nama_panjang" style="font-size: 15px;">Jam Perawatan</div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-5">
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
                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 text-center my-lg-0 my-4">
                            <img src="{{ asset('public/foto_pesanan/'. $pesanan->foto) }}" class="rounded" style="object-fit: cover; width: 200px; height: 200px; max-width: 100%; max-height: 100%;" id="myImgs" alt="Foto Luka Pasien" />
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
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 ms-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
                            <a href="https://wa.me/{{ $pesanan->user_pasien->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-borderless mt-4">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pesanan->user_pasien->NIK }}</td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pesanan->user_pasien->nama }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Data Tenaga Medis -->
                    <div class="shadow-tipis rounded-card py-3 px-3 mx-2 mt-4">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Medis ({{ $pesanan->status_jasa->status }})</div>
                            @if($pesanan->id_jasa)
                            <a href="https://wa.me/{{ $pesanan->status_jasa->notelp }}" class="d-inline justify-content-end ms-auto" target="_blank" rel="noopener">
                                <i class="fa fa-whatsapp fa-2xl" aria-hidden="true" style="color: #25D366"></i>
                            </a>
                            @endif
                        </div>
                        @if($pesanan->id_jasa)
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-borderless mt-4">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>NIP</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pesanan->user_jasa->NIK }}</td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pesanan->user_jasa->nama }}</td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Status</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $pesanan->status_jasa->status }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="montserrat-extra text-danger text-center mt-4">
                            Belum Pilih Tenaga Medis!
                            <br>
                            <button type="button" class="btn btn-primary mt-2" id="btn-pilih" data-bs-toggle="modal" data-bs-target="#modalPilihPerawat">
                                Pilih {{ $pesanan->status_jasa->status }}
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
                                                <label for="NIK_jasa">{{ $pesanan->status_jasa->status }}</label>

                                                <!-- Cek kalau tidak ada tenaga medis dengan status tersebut -->
                                                @if(!empty($nikJasa))
                                                <select class="form-control select2 mt-2" name="id_jasa" id="id_jasa">
                                                    <option disabled value>Pilih Tenaga Medis</option>

                                                    @foreach($nikJasa as $item)
                                                        @php $ada = false; @endphp
                                                        @foreach($cek_jasa_INpesanan as $item2)
                                                            @if ($item2->id_jasa == $item->id)
                                                                @php $ada = true; @endphp
                                                            @endif
                                                        @endforeach
                                                        @if($ada == true)
                                                        <option disabled value> {{ $item->nama }} - {{ $item->NIK }} melayani pasien di jadwal ini</option>
                                                        @else
                                                        <option value="{{ $item->id }}" @if ($item->NIK == $pesanan->NIK_jasa)
                                                                selected="selected"
                                                                @endif
                                                                > {{ $item->nama }} - {{ $item->NIK }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                <div class="montserrat-extra text-danger mt-3">Tidak ada {{ $pesanan->status_jasa->status }} yang aktif atau tersedia!</div>
                                                @endif
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
                                <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
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
                                    <button type="submit" class="btn btn-primary" id="btn-konfirmasi-sedang">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <!-- Modal Tolak Pesanan -->
            <form action="{{ url('detailPesanan/tolak/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

                <div class="modal fade" id="modalTolakPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-tipis">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                                <div class="text-center">
                                    <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
                                </div>
                                <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Tolak Pesanan</div>
                                <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin menolak pesanan ini?
                                    <br>Disarankan untuk menghubungi pasien terlebih dahulu sebelum membatalkan pesanan ini !
                                </div>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-6 text-center">
                                    <!-- Buttton Cancel -->
                                    <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <!-- Button Konfirmasi Pesanan -->
                                    <button type="submit" class="btn btn-primary" id="btn-tolak">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <!-- Modal Alert Belum Bayar -->
            <div class="modal fade" id="modalAlertBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content shadow-tipis">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
                            </div>
                            <div class="text-center montserrat-extra mt-3">Warning</div>
                            <div class="text-center montserrat-bold mt-4 color-abu">Gagal Menyelesaikan Pesanan! <br>Silahkan upload bukti pembayaran di Menu Edit</div>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Selesai Pesanan -->
            <form action="{{ url('detailPesanan/selesai/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

                <div class="modal fade" id="modalSelesaiPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-tipis">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                                <div class="text-center">
                                    <i class="fa-solid fa-triangle-exclamation" style="color: #4AD396; font-size: 70px;"></i>
                                </div>
                                <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Selesaikan Pesanan</div>
                                <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin menyelesaikan pesanan ini?
                                    <br>Pastikan perawat sudah selesai berkunjung ke rumah pasien dan bukti pembayaran sudah ditambah di Menu Edit
                                </div>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-6 text-center">
                                    <!-- Buttton Cancel -->
                                    <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <!-- Button Selesai Pesanan -->
                                    <button type="submit" class="btn btn-primary" id="btn-selesai">Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="mt-5 me-5 d-flex">

                <div class="text-start d-inline me-auto">
                    <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="btn-edit">Edit</a>
                </div>

                <div class="text-end d-inline ms-auto">

                    <!-- Kalau status layanan nya Menunggu -->
                    @if($pesanan->status_pesanan->status == "Menunggu")
                    <!-- Button tolak -->
                    <button type="button" class="btn btn-success me-3 ms-3" id="btn-tolak" data-bs-toggle="modal" data-bs-target="#modalTolakPesanan">
                        Tolak
                    </button>

                    <!-- Kalau sudah pilih jasa-->
                    @if($pesanan->id_jasa)
                    <button type="button" class="btn btn-success me-5 ms-3" id="btn-konfirmasi-sedang" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiPesanan">
                        Konfirmasi
                    </button>
                    @else
                    <!-- Kalau belum pilih jasa -->
                    <button type="button" class="btn btn-success me-5 ms-3" id="btn-konfirmasi-sedang" data-bs-toggle="modal" data-bs-target="#modalAlert">
                        Konfirmasi
                    </button>
                    @endif

                    @elseif($pesanan->status_pesanan->status == "Berlangsung")
                    <!-- Kalau status pembayaran sudah Y atau bukti_pembayaran ada-->
                    @if($pesanan->status_pembayaran == 'Y' || $pesanan->bukti_pembayaran != null)
                    <button type="button" class="btn btn-success me-5 ms-3" id="btn-selesai" data-bs-toggle="modal" data-bs-target="#modalSelesaiPesanan">
                        Selesai
                    </button>
                    @else
                    <button type="button" class="btn btn-success me-5 ms-3" id="btn-selesai" data-bs-toggle="modal" data-bs-target="#modalAlertBayar">
                        Selesai
                    </button>
                    @endif

                    @endif
                </div>

            </div>
        </div>

        <!-- Modal Foto -->
        <div id="modalBayar" class="modals">

            <!-- The Close Button -->
            <span class="closeBayar">&times;</span>

            <!-- Modal Content (The Image) -->
            <img class="modals-content" id="img02">

            <!-- Modal Caption (Image Text) -->
            <div id="captionBayar"></div>
        </div>
        @if($pesanan->bukti_pembayaran != null)
        <!-- Modal Tolak Pesanan -->
        <form action="{{ url('pesan/hapuspembayaran/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
            @method("PATCH")
            @csrf

            <div class="modal fade" id="modalHapusBuktiPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content shadow-tipis">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">
                            <div class="text-center">
                                <i class="fa-solid fa-triangle-exclamation" style="color: #ee627e; font-size: 70px;"></i>
                            </div>
                            <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Hapus Bukti Pembayaran</div>
                            <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin menghapus bukti pembayaran ini ?</div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-md-6 text-center">
                                <!-- Buttton Cancel -->
                                <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6 text-center">
                                <!-- Button Konfirmasi Pesanan -->
                                <button type="submit" class="btn btn-primary" id="btn-tolak">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <div class="my-2 montserrat-bold text-start">Bukti pembayaran</label>
            <div class="my-2">
                <img src="{{ asset('public/public/bukti_pembayaran/'.$pesanan->bukti_pembayaran) }}" id="imgBayar" alt="Bukti Pembayaran" width="100">
            </div>
            @if($pesanan->id_status_pesanan != 'S')
                <button type="button" class="btn btn-success my-2" id="btn-tolak-kecil" data-bs-toggle="modal" data-bs-target="#modalHapusBuktiPembayaran">Hapus</button>
            @endif
        </div>
        @endif

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