<x-inti-layout>

    <div class="container">
        <div class="py-12">
            <div class="py-12">
                <div class="pt-5">
                    <a href="{{ URL::previous() }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>
                    <h6 class="mt-5 montserrat-med text-start color-abu-muda">{{ $layanan->deskripsi }}</h6>
                    @if($harga_layanan != null)
                    <h4 class="montserrat-bold text-start mt-4">Info Harga</h4>
                    @foreach($harga_layanan as $item)
                        <h4 class="montserrat-bold text-start mt-4">{{ $item->status_user->status }} = {{ $item->harga }}</h4>
                    @endforeach                    
                    @endif
                    <a href="{{ url('/pesan/addView/'.$layanan->id) }}" class="btn btn-primary">Pesan</a>
                </div>
            </div>
        </div>

    </div>

</x-inti-layout>