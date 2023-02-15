<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Halaman Update Layanan</title>
</head>
<body>
    <hr>
    <a href="{{ route('layanan.main') }}" class="btn">Daftar Layanan</a>
    <br><hr>
    <h2>Form Update Layanan</h2>
    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif
    <form action="{{ url('daftarLayanan/update/'.$layanan->id) }}" method="post" enctype="multipart/form-data">
    @method("PATCH")
    @csrf

        <div class="form-group">
            <label for="nama_layanan">Nama Layanan</label>
            <input type="text" name="nama_layanan" id="nama_layanan" placeholder="Masukkan Nama Layanan" class="form-control my-2" value="{{ old('nama_layanan') ?? $layanan->nama_layanan }}">
            @error('nama_layanan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" class="form-control my-2" value="{{ old('deskripsi') ?? $layanan->deskripsi }}">
            @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_status_jasa">jasa yang tersedia</label><br>
            @foreach($allJasa as $item)
                @if($item->status !== "Pasien" && $item->status !== "Admin")
                    <input  type="checkbox" id="jasa{{ $item->id }}" name="jasa[]" value="{{ $item->id }}" 
                        @foreach($jasa as $item2)                        
                            @if($item->id == $item2->id_status_jasa)
                            checked="checked"
                            @endif                                           
                        @endforeach onclick="show('{{ $item->id }}')"    
                    />  {{ $item->status }} 
                    <div class="harga">
                        <input type="integer"  name="harga[]" id="harga{{ $item->id }}" placeholder="Masukkan harga" 
                        
                        @if($jasa->isEmpty())  
                        style="display: none;"                                      
                        @else
                            @foreach($jasa as $item2)                        
                                @if($item->id == $item2->id_status_jasa)
                                value="{{ old('harga') ?? $item2->harga }}"
                                style="display: block;" 
                                @else
                                style="display: none;" 
                                @endif                                           
                            @endforeach 
                        @endif
                        
                        
                        ><br>
                    </div><br>        
                @endif                
            @endforeach
        </div>


        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Ubah</button>
    </form>
    <hr>
    
</body>
</html>
<script>
    function show(id) {
        var jasa = document.getElementById("jasa"+id)
        var harga = document.getElementById("harga"+id)
        if(jasa.checked == true)
        {
            harga.style.display = "block"
            harga.value = ""
        }
        else if(jasa.checked == false)
        {
            harga.style.display = "none"
            harga.value = ""
            
        }
    }
</script>