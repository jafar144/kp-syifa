@section('title', 'Halaman Fakultas')
<x-inti-layout>

    <div class="container">

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
        <div class="pb-3">
            <h4 class="montserrat-extra content-sub text-center mt-5"><strong>LAYANAN</strong></h4>
        </div>

        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Cari Layanan . . . " value="{{ old('search') }}" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="row my-4 alldata">
            @foreach($layanan as $key => $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="">
                    <a href="{{ url('/daftarLayanan/detail/'.$item->id) }}" class="remove-underline">
                        <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">{{ $item->nama_layanan }}</h5>
                        <div class="card-body">
                            <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">{{ $item->deskripsi }}</p>
                        </div>
                    </a>
                    <a type="button" href="{{ url('/daftarLayanan/detail/'.$item->id) }}" class="btn btn-primary my-2 ms-auto me-auto py-2 px-3" id="pesan-btn">Lihat</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row my-4" id="search_list">

        </div>

    </div>

</x-inti-layout>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if(query != "")
            {
                $('.alldata').hide();
                $('#search_list').show();
                $.ajax({
                url: "homePasien/search",
                type: "GET",
                data: {
                    'search': query
                },
                success: function(data) {
                    $('#search_list').html(data);
                }
                });
            }
            else
            {
                $('.alldata').show();
                $('#search_list').hide();
            }
        });
    });
</script>