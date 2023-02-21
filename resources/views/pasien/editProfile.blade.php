<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title></title>
</head>
<body>
    @if (session()->has('info'))    
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif
    <hr>
    <form action="{{ url('profile/update/'.$user->id) }}" method="post" enctype="multipart/form-data">
    @method("PATCH")
    @csrf

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama_layanan" placeholder="nama" class="form-control my-2" value="{{ old('nama') ?? $user->nama }}">
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="alamat" class="form-control my-2" value="{{ old('alamat') ?? $user->alamat }}">
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="notelp">notelp</label>
            <input type="integer" name="notelp" id="notelp" placeholder="notelp" class="form-control my-2" value="{{ old('notelp') ?? $user->notelp }}">
            @error('notelp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
                            <label for="tanggal_lahir">ttl </label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan tanggal perawatan" class="form-control my-2" value="{{ old('tanggal_lahir') ?? $user->tanggal_lahir}}">
                            @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">save</button>
    </form>

    
</body>
</html>