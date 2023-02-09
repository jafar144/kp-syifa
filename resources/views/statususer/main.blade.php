<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Status User</title>
</head>
<body>
    <hr>
    <br><hr>
    <h1>Status User</h1>
    <hr><hr>

    <a href="{{ route('statususer.addView') }}" class="btn btn-primary">Tambah Status User</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statususer as $key=>$item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <form action="{{ url('/statusUser/delete/'.$item->id) }}" method="POST">
                        <a href="{{ url('/statusUser/detail/'.$item->id) }}" class="btn btn-warning">Detail</a>
                        <a href="{{ url('/statusUser/updateView/'.$item->id) }}" class="btn btn-warning">Ubah</a>
                        {{ $angka[$key]["count(status)"] }}
                        @method('DELETE')
                        @csrf
                        @if($angka[$key]["count(status)"] > 0)
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        @endif
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    
</body>
</html>