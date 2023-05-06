<x-inti-layout :title="'Home'">

    <div class="container">

        <a href="https://wa.me/628117830717" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <!-- Header -->
        <div class="py-12">
            <div class="py-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h4 class="montserrat-extra text-start mt-5 header-text">Lorem Ipsum Dolor Asit Amet <br> Hayya Noo Inisial E</h4>
                        <p class="color-abu-muda montserrat-med mt-3 fw-normal">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                        <div class="color-abu montserrat-med mt-3 fw-normal">Open : <span class="montserrat-extra fs-4 ms-2">07.00 - 20.00</span></div>
                    </div>
                    <div class="col-lg-6 col-md-6 py-5">
                        <img src="{{ asset('image/Logo_Klinik_Hitams.png') }}" class="image ms-auto me-auto d-none d-sm-none d-md-block" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Layanan -->
        <div class="pb-3 d-flex">
            <h4 class="montserrat-extra content-sub text-center mt-5 me-auto"><strong>LAYANAN</strong></h4>
            <div class="search-box ms-auto mt-auto">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="search" name="search" placeholder="Cari Layanan . . .">
            </div>
        </div>

        <div class="row my-4 alldata">
            @foreach($layanan as $key => $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="" style="height: 14rem;">
                    <a href="{{ url('/layanan/'.$item->id) }}" class="remove-underline">
                        <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">{{ $item->nama_layanan }}</h6>
                        <div class="card-body">
                            <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">{{ $item->deskripsi }}</p>
                        </div>
                    </a>
                    <a type="button" href="{{ url('/layanan/'.$item->id) }}" class="btn btn-primary my-1 mt-auto ms-auto me-auto py-2 px-3" id="pesan-btn">Lihat</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row my-4" id="search_list">

        </div>

    </div>

</x-inti-layout>

<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if (query != "") {
                $('.alldata').hide();
                $('#search_list').show();
                $.ajax({
                    url: "home/search",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#search_list').html(data);
                    }
                });
            } else {
                $('.alldata').show();
                $('#search_list').hide();
            }
        });
    });
</script>