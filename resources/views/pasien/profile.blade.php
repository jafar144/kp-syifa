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
    <hr>
    NIK = {{  $user->NIK  }} <br>
    nama = {{  $user->nama  }} <br>
    alamat = {{  $user->alamat  }} <br>
    <a href="{{ url('profile/editProfile') }}">edit profile</a>
    <hr>
    <h1>riwayat pemesanan</h1>
    <hr>
    @foreach($pesanan as $item)
    @if($item->id_status_layanan == "M")
    <a href="{{ url('/batalPesanan/'.$item->id) }}">BATALKAN</a><br>
    @endif
    
    layanan = {{  $item->layanan->nama_layanan  }} <br>
    jasa = {{ $item->status_jasa->status  }} <br>
    status = {{  $item->status_layanan->status  }} <br> <hr>
    
    @endforeach

    
</body>
</html>