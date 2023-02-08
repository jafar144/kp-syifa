<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
    <hr>

    <br><hr>
    <h1>Layanan</h1>
    <hr><hr>
    <a href="{{ route('layanan.addView') }}" class="btn btn-primary">Tambah Layanan</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($layanan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_layanan }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <form action="{{ url('/daftarLayanan/delete/'.$item->id) }}" method="POST">
                        <a href="{{ url('/daftarLayanan/detail/'.$item->id) }}" class="btn btn-warning">Detail</a>
                        <a href="{{ url('/daftarLayanan/updateView/'.$item->id) }}" class="btn btn-warning">Ubah</a>
                            
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