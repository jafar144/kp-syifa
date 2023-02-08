<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Update Harga Layanan</title>
</head>
<body>
    <hr>
    <a href="{{ route('hargalayanan.main') }}" class="btn">Daftar Harga Layanan</a>

    <br><hr>
    <h2>Form Update Harga Layanan</h2>
    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif


    <form action="{{ url('hargaLayanan/update/'.$hargalayanan->id) }}" method="post" enctype="multipart/form-data">
    @method("PATCH")
    @csrf

        <div class="form-group">
            <label for="id_layanan">Layanan</label>

            <select class="form-control select2" name="id_layanan" id="id_layanan">
                <option disabled value>Pilih Layanan</option>

                @foreach($layanans as $item)

                <option value="{{ $item->id }}"
                    @if ($item->id == $hargalayanan->id_layanan)
                        selected="selected"
                    @endif
                > {{ $item->nama_layanan }}</option>
                
                @endforeach
            </select>

            @error('id_layanan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
        <label for="id_status_jasa">Jasa</label>
            <select class="form-control select2" name="id_status_jasa" id="id_status_jasa">
                <option disabled value>Pilih Jasa</option>
                @foreach($jasa as $item)

                <option value="{{ $item->id }}"
                    @if ($item->id == $hargalayanan->id_status_jasa)
                        selected="selected"
                    @endif
                > {{ $item->status }}</option>

                @endforeach


            </select>
            
            @error('id_status_jasa')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="integer" name="harga" id="harga" placeholder="Masukkan harga Layanan" class="form-control my-2" value="{{ old('harga') ?? $hargalayanan->harga }}">
            @error('harga')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Ubah</button>
    </form>
    <hr>
    
</body>
</html>
