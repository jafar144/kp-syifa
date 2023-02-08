<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Harga Layanan</title>
</head>
<body>
    <hr>
    <a href="{{ route('statususer.main') }}" class="btn">Daftar Status User</a>
    <a href="{{ route('layanan.main') }}" class="btn">Daftar Layanan</a>
    <br><hr>
    <h1>Harga Layanan</h1>
    <hr><hr>

    <a href="{{ route('hargalayanan.addView') }}" class="btn btn-primary">Tambah</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID Harga</th>
                <th>ID Layanan</th>
                <th>ID Jasa</th>
                <th>Harga</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hargalayanan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->layanan->nama_layanan }}</td>
                <td>{{ $item->status_user->status }}</td>
                <td>{{ $item->harga }}</td>
                <td>
                    <form action="{{ url('/hargaLayanan/delete/'.$item->id) }}" method="POST">
                        <a href="{{ url('/hargaLayanan/detail/'.$item->id) }}" class="btn btn-warning">Detail</a>
                        <a href="{{ url('/hargaLayanan/updateView/'.$item->id) }}" class="btn btn-warning">Ubah</a>
                            
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    
</body>
</html>
