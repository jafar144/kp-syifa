<x-inti-layout :title="'Detail Pesanan'">

    <div class="container">

        <a href="https://wa.me/628117830717" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-5">

                    <div class="d-flex">
                        <div class="d-inline mt-4 mb-3">
                            <!-- Header -->
                            <a href="{{ url('/profile') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Pesanan Saya</h3>
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
                        <div class="col-lg-8 col-md-12 shadow-tipis rounded-card py-4 px-4 mx-3">
                            <div class="d-flex">
                                <div class="montserrat-extra color-inti text-start justify-content-start d-inline" style="font-size: larger;">{{ $pesanan->layanan->nama_layanan }}</div>
                                <div class="d-inline justify-content-end status_chip ms-auto">{{ $pesanan->status_pesanan->status }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-7">
                                    <table class="table table-borderless mt-4">
                                        <tbody>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Harga </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; Rp @currency($pesanan->harga)</td>
                                            </tr>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Ongkos </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; Rp @currency($pesanan->ongkos)</td>
                                            </tr>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Total </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; Rp @currency($pesanan->harga + $pesanan->ongkos)</td>
                                            </tr>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Tanggal Perawatan </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; {{ $pesanan->getTanggal($pesanan->tanggal_perawatan) }}</td>
                                            </tr>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Jam Perawatan </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; {{ $pesanan->getJamPerawatan($pesanan->jam_perawatan) }}</td>
                                            </tr>
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Tenaga Medis </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; {{ $pesanan->status_jasa->status }}</td>
                                            </tr>
                                            @if($pesanan->id_jasa)
                                            <tr class="montserrat-bold font-smaller">
                                                <td>Nama Perawat </td>
                                                <td class="montserrat-extra color-abu">: &nbsp; {{ $pesanan->user_jasa->nama }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                @if($pesanan->foto)
                                <div class="col-lg-5 col-md-12 col-sm-12 col-12 mt-4">
                                    <img src="{{ asset('storage/'. $pesanan->foto) }}" class="rounded ms-lg-auto me-lg-2 ms-auto me-auto" style="object-fit: cover; width: 180px; height: 180px; max-width: 100%; max-height: 100%;" id="myImgs" alt="Foto Luka Pasien" />
                                </div>
                                @endif

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
                    </div>
                    <div class="montserrat-extra color-inti mt-4">Silahkan hubungi admin jika ada pertanyaan terkait pemesanan</div>
                    <div class="mt-4">
                        <a href="https://wa.me/628117830717" class="btn btn-success" id="custom-wa-button" target="_blank" rel="noopener">
                            <i class="fa fa-whatsapp fa-xl" aria-hidden="true"></i> &nbsp; Hubungi Kami
                        </a>
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
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.custom-alert').removeClass("show");
        $('.custom-alert').addClass("hide");
    });
</script>