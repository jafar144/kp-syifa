<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/toggle.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Tambah Staff</title>
</head>

<body>
    @if (session()->has('info'))
    <div class="alert alert-success">
        {{ session()->get('info') }}
    </div>
    @endif
    <form action="{{ url('daftarStaff/add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" placeholder="Masukkan NIK" class="form-control my-2" value="{{ old('nik') }}">
            @error('nik')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan nama" class="form-control my-2" value="{{ old('nama') }}">
            @error('nama')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" name="email" id="email" placeholder="Masukkan email" class="form-control my-2" value="{{ old('email') }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        password 
        ttl 
        jk 
        status 
        notelp 


        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
    </form>
    <hr>

</body>
</html>