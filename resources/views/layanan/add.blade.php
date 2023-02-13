<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Tambah Layanan</title>
</head>

<body>
    <hr>
    <a href="{{ route('layanan.main') }}" class="btn">Daftar Layanan</a>
    <br>
    <hr>

    <h2>Form Add Layanan</h2>
    @if (session()->has('info'))
    <div class="alert alert-success">
        {{ session()->get('info') }}
    </div>
    @endif
    <form action="{{ url('daftarLayanan/add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_layanan">Nama Layanan</label>
            <input type="text" name="nama_layanan" id="nama_layanan" placeholder="Masukkan Nama Layanan" class="form-control my-2" value="{{ old('nama_layanan') }}">
            @error('nama_layanan')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" class="form-control my-2" value="{{ old('deskripsi') }}">
            @error('deskripsi')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_status_jasa">jasa yang tersedia</label><br>
            @foreach($statusjasa as $item)
            @if($item->status !== "Pasien" && $item->status !== "Admin")
            <input type="checkbox" name="jasa[]" value="{{ $item->id }}" id="jasa{{ $item->id }}" onclick="show('{{ $item->id }}')" /> {{ $item->status }}
            <div class="harga" id="harga">

            </div>
            @endif
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Simpan</button>
    </form>
    <hr>

</body>

</html>

<script>
    function show(id) {
        var jasa = document.getElementById("jasa"+id)
        if(jasa.checked == true)
        {
            addListHarga();
        }
        else if(jasa.checked == false)
        {
            removeListHarga();
        }
    }

    function addListHarga()
    {
        let newHarga = document.createElement('input');
        newHarga.type = 'integer';
        newHarga.name = 'harga[]';
        newHarga.id = '{{ $item->id }}'
        newHarga.placeholder = 'Masukkan harga';
        newHarga.value = "{{ old('harga') }}";
        document.getElementById("harga").appendChild(newHarga);
    }

    function removeListHarga()
    {
        let parent = document.getElementById('harga');
        let listHarga = document.getElementById('{{ $item->id }}');
        parent.removeChild(listHarga);
    }

</script>