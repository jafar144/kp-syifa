<h1>DAFTAR ALAMAT SAYA</h1>
<a href="/profile/alamat/addView">add</a>
@if (session()->has('info'))
<div class="alert alert-success">
    {{ session()->get('info') }}
</div>
@endif
@foreach($alamat as $item)
    <hr>{{$item->alamat}}
    <br>
    <a href="{{ url('/profile/alamat/updateView/'.$item->id) }}" >update</a>
    <form action="{{ url('/profile/alamat/delete/'.$item->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-primary" id="hapus-btn">Hapus</button>
    </form>
@endforeach