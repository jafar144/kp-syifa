@if (session()->has('info'))
<div class="alert alert-success">
    {{ session()->get('info') }}
</div>
@endif

<form action="{{ url('/profile/alamat/add') }}" method="post" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') }}">
        @error('alamat')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="detail">Detail alamat / patokan</label>
        <input type="text" name="detail" id="detail" placeholder="Masukkan detail alamat" class="form-control my-2" value="{{ old('detail') }}">
        @error('detail')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
        

    <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
</form>