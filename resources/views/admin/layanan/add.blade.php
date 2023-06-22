<x-admin-layout :title="'Tambah Layanan'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarLayanan') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Tambah Layanan</h3>

            <div class="mt-4">
                @if($errors->any())
                    {!! implode('', $errors->all('
                        <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                    ')) !!}
                @endif
            </div>

            <form action="{{ url('daftarLayanan/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Layanan</div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-2">
                                    <div class="montserrat-bold mt-2" style="font-size: 15px;">Nama Layanan</div>
                                    <div class="montserrat-bold" style="font-size: 15px; margin-top: 32px;">Deskripsi</div>
                                    <div class="montserrat-bold" style="font-size: 15px; margin-top: 40px;">Pakai Foto</div>
                                    <div class="montserrat-bold" style="font-size: 15px; margin-top: 41px;">Tampilkan</div>
                                </div>
                                <div class="col-lg-10">

                                    <input type="text" name="nama_layanan" id="nama_layanan" placeholder="Masukkan Nama Layanan" class="form-control" value="{{ old('nama_layanan') }}">

                                    <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" class="form-control my-3" value="{{ old('deskripsi') }}" style="font-size: 16px;">

                                    <!-- Pakai Foto Layanan -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch" name="use_foto" />
                                        <label class="toggle" for="switch">Toggle</label>
                                    </div>

                                    <!-- Tampilkan Layanan -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch-1" name="show" />
                                        <label class="toggle-1" for="switch-1">Toggle</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-5">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Harga Layanan</div>
                            </div>
                            <div class="row mt-4 px-2">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr class="d-flex mt-3">
                                            <th scope="col" class="col-md-1 col-sm-2 col-2"></th>
                                            <th scope="col" class="col-md-2 col-sm-5 col-5">Tenaga Medis</th>
                                            <th scope="col" class="col-md-2 col-sm-5 col-5">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($statusjasa as $item)
                                        <tr class="d-flex mt-2">
                                            @if($item->status !== "Pasien" && $item->status !== "Admin")

                                            <!-- Checkbox -->
                                            <td scope="row" class="col-md-1 col-sm-2 col-2">
                                                <input type="checkbox" class="checkbox-rounded" id="jasa{{ $item->id }}" name="jasa[]" value="{{ $item->id }}" onclick="showHarga('{{ $item->id }}')" />
                                            </td>

                                            <!-- Jasa -->
                                            <td scope="row" class="col-md-2 col-sm-5 col-5">{{ $item->status }}</td>

                                            <!-- Harga -->
                                            <td class="col-md-2 col-sm-5 col-5">
                                                <input type="number" name="harga[]" id="harga{{ $item->id }}" onkeydown="return event.keyCode !== 69" oninput="validateInput(this)" placeholder="Masukkan harga" style="display: none;" />
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Tambah</button>

            </form>
        </div>
    </div>

</x-admin-layout>

<script>
    function validateInput(input) {
      input.value = input.value.replace(/[+-,.]/g, ''); // Remove '+' and '-' characters
    }
</script>

<script>
    function showHarga(id) {
        var jasa = document.getElementById("jasa" + id)
        var harga = document.getElementById("harga" + id)
        if (jasa.checked == true) {
            harga.style.display = "block"
        } else if (jasa.checked == false) {
            harga.style.display = "none"
            harga.value = ""
        }
    }
</script>