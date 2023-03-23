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
    status = {{  $item->status_layanan->status  }} <br> 
    
    <a href="{{ url('/detailPesanan/'.$item->id) }}">Detail</a><br>   
    <hr> 
@endforeach
