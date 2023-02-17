<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Update Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <hr/>
    <h2>Form Update Pesanan</h2>
        <form action="{{ url('pesan/update/'.$pesanan->id) }}" method="post" enctype="multipart/form-data">
        @method("PATCH")
        @csrf

            <div class="form-group">
                <label for="layanan">Layanan</label>

                <select class="form-control select2" name="layanan" id="layanan">
                    <option disabled value>Pilih Layanan</option>

                    @foreach($layanan as $item)

                    <option value="{{ $item->id }}"
                        @if ($item->id == $pesanan->id_layanan)
                            selected="selected"
                        @endif
                    > {{ $item->nama_layanan }}</option>
                    
                    @endforeach
                </select>

                @error('layanan')
                    <div class="text-danger">{{ $message }}</div>
                    
                @enderror
            </div>

            <div class="form-group">
                <label for="status_jasa">status jasa</label>

                <select class="form-control select2" name="status_jasa" id="status_jasa">
                    @foreach($statusJasa as $item)
                    <option value="{{ $item->id_status_jasa }}"
                        @if ($item->id_status_jasa == $pesanan->id_status_jasa)
                                    selected="selected"
                        @endif
                    > {{ $item->status_user->status }}</option>             
                    @endforeach
                </select>

                @error('status_jasa')
                    <div class="text-danger">{{ $message }}</div>
                    
                @enderror
            </div>

            <div class="form-group">
                <label for="NIK_jasa">NIK </label>

                <select class="form-control select2" name="NIK_jasa" id="NIK_jasa">
                    <option disabled value>Pilih NIK jasa</option>

                    @foreach($nikJasa as $item)

                    <option value="{{ $item->NIK }}"
                        @if ($item->NIK == $pesanan->NIK_jasa)
                            selected="selected"
                        @endif
                    > {{ $item->nama }}  ;  {{ $item->NIK }}</option>
                    
                    @endforeach
                </select>

                @error('NIK_jasa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_status_layanan">status layanan </label>

                <select class="form-control select2" name="id_status_layanan" id="id_status_layanan">
                    <option disabled value>Pilih status layanan</option>

                    @foreach($statusLayanan as $item)

                    <option value="{{ $item->id }}"
                        @if ($item->id == $pesanan->id_status_layanan)
                            selected="selected"
                        @endif
                    > {{ $item->status }}</option>
                    
                    @endforeach
                </select>

                @error('id_status_layanan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status_pembayaran">status pembayaran</label>

                <select class="form-control select2" name="status_pembayaran" id="status_pembayaran">
                    <option disabled value>Pilih status pembayaran</option>

                    <option value="Y"
                        @if ($pesanan->status_pembayaran == "Y")
                            selected="selected"
                        @endif
                    >Lunas</option>

                    <option value="T" selected="selected">Tidak Lunas</option>
                    
                </select>

                @error('status_pembayaran')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') ?? $pesanan->alamat }}">
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keluhan">keluhan</label>
                <input type="text" name="keluhan" id="keluhan" placeholder="Masukkan keluhan" class="form-control my-2" value="{{ old('keluhan') ?? $pesanan->keluhan }}">
                @error('keluhan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_perawatan">tanggal_perawatan</label>
                <input type="date" name="tanggal_perawatan" id="tanggal_perawatan" placeholder="Masukkan tanggal_perawatan" class="form-control my-2" value="{{ old('tanggal_perawatan') ?? $pesanan->tanggal_perawatan }}">
                @error('tanggal_perawatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_perawatan">jam_perawatan</label>
                <input type="time" name="jam_perawatan" id="jam_perawatan" placeholder="Masukkan jam_perawatan" class="form-control my-2" value="{{ old('jam_perawatan') ?? $pesanan->jam_perawatan }}">
                @error('jam_perawatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Ubah</button>
        </form>

    <hr/>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#layanan').on('change', function(){
            var layananID = $(this).val();
            if(layananID){
                $.ajax({
                    url: '/getJasa/'+layananID,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data)
                    {
                        if(data){
                            $('#status_jasa').empty();
                            console.log(data);
                            $.each(data, function(key, status_jasa){
                                $('select[name="status_jasa"]').append('<option value="'+ status_jasa.id_status_jasa +'">' +  status_jasa.status_user.status + '</option>');
                            });
                        }else{
                            $('#status_jasa').empty();
                        }
                    }
                });
            }else{
                $('#status_jasa').empty();
            }
        });
    });

    $(document).ready(function(){
        $('#status_jasa').on('change', function(){
            var status_jasaID = $(this).val();
            if(status_jasaID){
                $.ajax({
                    url: '/getNik/'+status_jasaID,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data)
                    {
                        if(data){
                            $('#NIK_jasa').empty();
                            console.log(data);
                            $.each(data, function(key, nik_jasa){
                                $('select[name="NIK_jasa"]').append('<option value="'+ nik_jasa.NIK +'">' +  nik_jasa.NIK + ' ; '  + nik_jasa.nama + '</option>');
                            });
                        }else{
                            $('#NIK_jasa').empty();
                        }
                    }
                });
            }else{
                $('#NIK_jasa').empty();
            }
        });
    });
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   
</html>