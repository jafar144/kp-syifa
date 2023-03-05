<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <hr/>
    {{ $pesanan }}

    <hr>
    <a href="{{ url('/pesan/updateView/'.$pesanan->id) }}" class="btn btn-success" id="pesan-btn">Edit</a>
    <h2>BIODATA PASIEN</h2>
    nik = {{ $pesanan->user_pasien->NIK }} <br>
    nama = {{ $pesanan->user_pasien->nama }} <br>
    notelp = {{ $pesanan->user_pasien->notelp }} <br>
    <hr>
    <h2>BIODATA MEDIS</h2>
    @if($pesanan->id_jasa)
    status medis = {{ $pesanan->status_jasa->status }} <br>
    nik = {{ $pesanan->user_jasa->NIK }} <br>
    nama = {{ $pesanan->user_jasa->nama }} <br>
    notelp = {{ $pesanan->user_jasa->notelp }} <br>
    @else
    silahkan pilih staff medis untuk melayani pesanan
    @endif
    <hr>
    <h2>PESANAN</h2>
    {{ $pesanan->layanan->nama_layanan }} <br>
    harga = {{ $pesanan->harga }} <br>
    ongkos = {{ $pesanan->ongkos }} <br>
    @if($pesanan->keluhan)
    keluhan = {{ $pesanan->keluhan }}<br>
    @endif
    @if($pesanan->foto)
    {{ $pesanan->foto }}<br>
    @endif
    jadwal :  {{ $pesanan->tanggal_perawatan }} , jam = {{ $pesanan->jam_perawatan }} <br>
    alamat : {{ $pesanan->alamat }}
    
    <hr/>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>