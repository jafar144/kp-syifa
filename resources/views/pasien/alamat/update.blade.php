<x-inti-layout :title="'Update Alamat'">

    <div class="container">

        <a href="https://wa.me/628117830717" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-4 px-3">
                    
                    <a href="{{ url('/profile/alamat') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">Edit Alamat</h3>

                    <div class="mt-4">
                        @if($errors->any())
                        {!! implode('', $errors->all('
                        <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                        ')) !!}
                        @endif
                    </div>

                    <form action="{{ url('/profile/alamat/update/'.$alamat->id) }}" method="post" enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf

                        <label for="alamat" class="mt-4">Alamat</label>
                        <div>
                            <input type="text" name="alamat" id="origin-input" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') ?? $alamat->alamat }}">
                        </div>
                        <div id="map" style="display: none;"></div>

                        <div class="font-smaller color-inti montserrat-bold">
                            <span class="text-start">Jarak ke Klinik (meter) : </span>
                            <input type="text" name="jarak" id="jarak" style="border: none;" size="8" value="{{ old('jarak') ?? $alamat->jarak }}" readonly>
                        </div>

                        <div class="form-group mt-4">
                            <label for="detail">Detail Alamat / Patokan</label>
                            <input type="text" name="detail" id="detail" placeholder="Contoh: samping indomaret, pagar biru" class="form-control my-2" value="{{ old('detail') ?? $alamat->detail }}">
                        </div>

                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Update</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</x-inti-layout>
<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">

<script src="{{ asset('js/map.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
