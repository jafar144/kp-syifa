<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>HAIII</title>
</head>
<body>
    <hr>
    HAIII
    <h3>ID = {{ $layanan->id }}</h3>

    <h2>Form Add Layanan</h2>
    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <form action="{{ url('pesan/add/'.$layanan->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    
        <div class="form-group">
            <label for="id_status_jasa">jasa</label>
            <select class="form-control select2" name="id_status_jasa" id="id_status_jasa">
                <option disabled value>Pilih jasa</option>
                @foreach($jasa as $item)
                @if($item->status !== "Pasien" || $item->status !== "Admin")
                    <option value="{{ $item->id }}"> {{ $item->status }}</option>
                @endif
                
                @endforeach
            </select>
            @error('id_status_jasa')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

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

        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
    </form>
    <hr>
    
</body>
</html>
