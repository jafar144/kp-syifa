<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Detail Layanan</title>
</head>
<body>
    <hr>
    <a href="/daftarLayanan">back</a>
    <h1>{{ $layanan->nama_layanan }}</h1>
    Tenaga medis : <br>
    @foreach($harga_layanan as $value)
    {{ $value->status_user->status }}= {{ $value->harga }} <br>
    @endforeach
    <hr>
    <a href="{{ url('/daftarLayanan/updateView/'.$layanan->id) }}" class="btn btn-success" id="pesan-btn">Edit</a>
    
</body>
</html>