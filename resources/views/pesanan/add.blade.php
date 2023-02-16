<x-inti-layout>

    <div class="container">
        <div class="py-12">
            <div class="py-12">
                <div class="mt-5">
                    <a  href="{{ url('/daftarLayanan/detail/'.$layanan->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>
                    @if (session()->has('info'))
                    <div class="alert alert-success">
                        {{ session()->get('info') }}
                    </div>
                    @endif

                    <form action="{{ url('pesan/add/'.$layanan->id) }}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <button onclick="getLocation()">Try It</button>
                            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat anda" class="form-control my-2" value="{{ old('alamat') ?? Auth::user()->alamat }}">
                            @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keluhan">Keluhan penyakit</label>
                            <input type="text" name="keluhan" id="keluhan" placeholder="Masukkan keluhan anda" class="form-control my-2" value="{{ old('keluhan') }}">
                            @error('keluhan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_perawatan">jadwal </label>
                            <input type="date" name="tanggal_perawatan" id="tanggal_perawatan" placeholder="Masukkan tanggal perawatan" class="form-control my-2" value="{{ old('tanggal_perawatan') }}">
                            @error('tanggal_perawatan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_perawatan">jam perawatan </label>
                            <input type="time" name="jam_perawatan" id="jam_perawatan" placeholder="Masukkan jam_perawatan" class="form-control my-2" value="{{ old('jam_perawatan') }}">
                            @error('jam_perawatan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($layanan->use_foto == 'Y')
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control my-2">
                            @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        
                        <div class="form-group">
                            <label for="id_status_jasa">jasa</label>
                            <select class="form-control select2" name="id_status_jasa" id="id_status_jasa">
                                <option disabled value>Pilih jasa</option>
                                @foreach($jasa as $item)
                                @if($item->status !== "Pasien" && $item->status !== "Admin")
                                <option value="{{ $item->id_status_jasa }}"> {{ $item->status_user->status }}</option>
                                @endif

                                @endforeach
                            </select>
                            @error('id_status_jasa')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-inti-layout>

<script>
        var x = document.getElementById("demo");
        
        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        }

        function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
        }
    </script>