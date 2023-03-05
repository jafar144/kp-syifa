<x-inti-layout>

    <div class="container">
        <div class="py-12">
            <div class="py-12">
                <div class="mt-5">
                    <a href="{{ url('/layanan/'.$layanan->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>
                    @if (session()->has('info'))
                    <div class="alert alert-success">
                        {{ session()->get('info') }}
                    </div>
                    @endif

                    <button onclick="getLocation()">Dapatkan Jarak</button>
                    <div id="demo"></div>
                    <div id="jarak">Jarak : </div>
                    <form action="{{ url('pesan/'.$layanan->id) }}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
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
                            <label for="tanggal_perawatan">Jadwal </label>
                            <input type="date" name="tanggal_perawatan" id="tanggal_perawatan" placeholder="Masukkan tanggal perawatan" class="form-control my-2" value="{{ old('tanggal_perawatan') }}">
                            @error('tanggal_perawatan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_perawatan">Jam Perawatan </label>
                            <input type="time" name="jam_perawatan" id="jam_perawatan" min="08:00" max="20:00" placeholder="Masukkan jam_perawatan" class="form-control my-2 without_ampm" value="{{ old('jam_perawatan') }}" required>
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
                            <label for="id_status_jasa">Jasa</label>
                            <select class="form-control select2 my-2" name="id_status_jasa" id="id_status_jasa">
                                <option disabled value>Pilih jasa</option>
                                @foreach($jasa as $item)
                                @if($item->status_user->status !== "Pasien" && $item->status_user->status !== "Admin" && $item->status_user->is_active !== "T")
                                <option value="{{ $item->id_status_jasa }}"> {{ $item->status_user->status }} -- Rp @currency($item->harga)</option>
                                @endif

                                @endforeach
                            </select>
                            @error('id_status_jasa')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-inti-layout>

<script>
    var x = document.getElementById("demo");
    let jarak = document.getElementById("jarak");
    let latKlinik = -2.976468339331823;
    let longKlinik = 104.77107129711293;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function success(position) {
        latUser = position.coords.latitude;
        longUser = position.coords.longitude;
        jarak.innerHTML = getDistanceFromLatLonInKm(latUser, longUser, latKlinik, longKlinik).toFixed(2) + " km";
        x.innerHTML = "Latitude: " + latUser +
            "<br>Longitude: " + longUser;
    }

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2 - lat1); // deg2rad below
        var dLon = deg2rad(lon2 - lon1);
        var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c; // Distance in km
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180)
    }
</script>