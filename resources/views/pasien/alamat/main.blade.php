<h1>DAFTAR ALAMAT SAYA</h1>
<a href="/profile/alamat/add">add</a>
@foreach($alamat as $item)
    <hr>{{$item->alamat}}
    <br>
    <a href="{{ url('/profile/alamat/update/'.$item->id) }}" >update</a>
@endforeach