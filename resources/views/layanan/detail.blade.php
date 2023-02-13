<x-inti-layout>

    <div class="container">
        <div class="py-12">
            <div class="py-12">
                <div class="pt-5">
                    <a href="{{ URL::previous() }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>
                    <h6 class="mt-5 montserrat-med text-start color-abu-muda">{{ $layanan->deskripsi }}</h6>
                    @if($harga_layanan != null)
                    <h5 class="montserrat-bold text-start mt-4">Harga : (Desain Nyusul)</h5>
                    @foreach($harga_layanan as $item)
                        <h5 class="montserrat-bold text-start mt-4"><i class="fa-solid fa-circle fa-2xs"></i> {{ $item->status_user->status }} = Rp{{ $item->harga }}</h5>
                    @endforeach                    
                    @endif
                    <a type="button" href="{{ url('/pesan/addView/'.$layanan->id) }}" class="btn btn-primary mt-4 ms-auto me-auto py-2 px-3" id="pesan-btn">Pesan</a>
                </div>
            </div>
        </div>

    </div>

</x-inti-layout>