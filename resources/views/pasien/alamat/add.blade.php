<x-inti-layout :title="'Daftar Alamat'">

    <div class="container">

        <div class="py-5">
            <div class="pt-5">
                <div class="pt-4 px-3">

                    @if (session()->has('info'))
                    <div class="alert alert-success">
                        {{ session()->get('info') }}
                    </div>
                    @endif

                    <div class="mt-4">
                        @if($errors->any())
                        {!! implode('', $errors->all('
                        <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                        ')) !!}
                        @endif
                    </div>

                    <a href="{{ url('/profile/alamat') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">Tambah Alamat</h3>

                    <form action="{{ url('/profile/alamat/add') }}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf

                        <label for="alamat">Alamat</label>
                        <!-- <div class="mt-4">
                            <input id="origin-input" class="form-control" type="text" placeholder="Enter an origin location" />
                        </div> -->
                        <div>
                            <input type="text" name="alamat" id="origin-input" placeholder="Masukkan alamat" class="form-control my-2">
                        </div>
                        <div id="map" style="display: none;"></div>

                        <div>
                            <span class="montserrat-bold text-start">Jarak ke Klinik (meter) : </span>
                            <input type="text" name="jarak" id="jarak" style="border: none;" readonly>
                        </div>

                        <div class="form-group mt-4">
                            <label for="detail">Detail Alamat / Patokan</label>
                            <input type="text" name="detail" id="detail" placeholder="Contoh: samping indomaret, pagar biru" class="form-control my-2" value="{{ old('detail') }}">
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</x-inti-layout>
<script src="{{ asset('js/map.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhFi_DeV49ieQ_kgMtM8-YOP03wDimivM&callback=initMap&libraries=places&v=weekly" defer></script>