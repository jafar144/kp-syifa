layanan = {{$pesanan->layanan->nama_layanan}} <br>
jasa = {{$pesanan->status_jasa->status}}<br>
@if($pesanan->id_jasa)
nama staff = {{$pesanan->user_jasa->nama}}<br>
@endif

keluhan = {{$pesanan->keluhan}}<br>
jadwal  = {{$pesanan->tanggal_perawatan}} , {{$pesanan->jam_perawatan}}<br>
alamat = {{$pesanan->alamat}}<br>
harga = {{$pesanan->harga}}<br>
@if($pesanan->id_status_layanan == 'M')
<a href="">Edit</a><br>  
@endif