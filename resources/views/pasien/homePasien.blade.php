@section('title', 'Halaman Fakultas')
<x-inti-layout>

    <div class="container">

        <!-- Layanan -->
        <div class="py-12">
            <h4 class="montserrat-extra content-sub text-center mt-5"><strong>LAYANAN</strong></h4>
        </div>

        <div class="row my-4">
            @foreach($layanan as $key => $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                <div class="p-3 card border-end-0 border-start-0 border-bottom-0 bg-inti-muda" id="">
                    <a href="{{ url('/daftarLayanan/detail/'.$item->id) }}" class="remove-underline">
                        <h6 class="montserrat-extra text-center mt-2 color-abu text-uppercase">{{ $item->nama_layanan }}</h5>
                        <div class="card-body">
                            <p class="card-text montserrat-med text-start color-abu-muda mt-2 teks" id="deskripsi">{{ $item->deskripsi }}</p>
                        </div>
                    </a>
                    <a type="button" href="{{ url('/daftarLayanan/detail/'.$item->id) }}" class="btn btn-primary my-2 ms-auto me-auto py-2 px-3" id="pesan-btn">Lanjut</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</x-inti-layout>