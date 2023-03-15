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
            <label for="NIK">NIK</label>
            <input type="text" name="NIK" id="NIK" placeholder="Masukkan NIK" class="form-control my-2" value="{{ old('NIK') }}">
            @error('NIK')
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
        <div class="form-group">
            <label for="notelp">notelp</label>
            <input type="text" name="notelp" id="notelp" placeholder="Masukkan nomor telpon" class="form-control my-2" value="{{ old('notelp') }}">
            @error('notelp')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') }}">
            @error('alamat')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control select2 my-2" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="" hidden>Jenis Kelamin</option>
                    <option value="P">Perempuan</option>
                    <option value="L">Laki-Laki</option>
                </select>
                @error('jenis_kelamin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group">
            <label for="status">Status</label>
                <select class="form-control select2 my-2" name="status" id="status">
                <option value="" hidden>Status</option>
                    @foreach($statusjasa as $item)
                    <option value="{{ $item->id }}"> {{ $item->status }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
        </div>        
        
        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
    </form>
    <hr>

</body>
</html>