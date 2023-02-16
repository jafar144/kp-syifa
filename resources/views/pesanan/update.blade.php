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
                <label for="id_layanan">Layanan</label>

                <select class="form-control select2" name="id_layanan" id="id_layanan">
                    <option disabled value>Pilih Layanan</option>

                    @foreach($layanan as $item)

                    <option value="{{ $item->id }}"
                        @if ($item->id == $pesanan->id_layanan)
                            selected="selected"
                        @endif
                    > {{ $item->nama_layanan }}</option>
                    
                    @endforeach
                </select>

                @error('id_layanan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_status_jasa">status jasa</label>

                <select class="form-control select2" name="id_status_jasa" id="id_status_jasa">
                    <option disabled value>Pilih Jasa</option>

                    @foreach($statusJasa as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id_status_jasa == $pesanan->id_status_jasa)
                                    selected="selected"
                                @endif
                    > {{ $item->status_user->status }}</option>                
                    @endforeach
                </select>

                @error('id_status_jasa')
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>