<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Tambah Status Layanan</title>
</head>
<body>
    <hr>
    <h2>Form Add Status Layanan</h2>
    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <form action="{{ url('statusLayanan/add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="id">Status Layanan</label>
            <input type="text" name="id" id="id" placeholder="Masukkan Status Layanan" class="form-control my-2" value="{{ old('id') }}">
            @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Keterangan Status Layanan</label>
            <input type="text" name="status" id="status" placeholder="Masukkan Keterangan Status Layanan" class="form-control my-2" value="{{ old('status') }}">
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
    </form>
    <hr>
    
</body>
</html>
