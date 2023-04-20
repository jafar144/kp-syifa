<x-admin-layout :title="'Update Layanan'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/detailLayanan/'.$layanan->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Edit Layanan</h3>

            <!-- @if (session()->has('info'))
            <div class="alert alert-success mt-4">
                {{ session()->get('info') }}
            </div>
            @endif -->

            <div class="mt-4">
                @if($errors->any())
                    {!! implode('', $errors->all('
                        <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                    ')) !!}
                @endif
            </div>

            <form action="{{ url('daftarLayanan/update/'.$layanan->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
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

                                    <input type="text" name="nama_layanan" id="nama_layanan" placeholder="Masukkan Nama Layanan" class="form-control" value="{{ old('nama_layanan') ?? $layanan->nama_layanan }}">

                                    <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" class="form-control my-3" value="{{ old('deskripsi') ?? $layanan->deskripsi }}" style="font-size: 16px;">

                                    <!-- Pakai Foto Layanan -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch" name="use_foto" @if($layanan->use_foto == "Y")
                                        checked
                                        @endif />
                                        <label class="toggle" for="switch">Toggle</label>
                                    </div>

                                    <!-- Tampilkan Layanan -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch-1" name="show" @if($layanan->show == "Y")
                                        checked
                                        @endif />
                                        <label class="toggle-1" for="switch-1">Toggle</label>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex mt-5">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Harga Layanan</div>
                            </div>
                            <div class="row mt-4 px-2">
                                @if($allJasa != null)
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr class="d-flex mt-3">
                                            <th scope="col" class="col-md-1 col-sm-2 col-2"></th>
                                            <th scope="col" class="col-md-2 col-sm-5 col-5">Tenaga Medis</th>
                                            <th scope="col" class="col-md-2 col-sm-5 col-5">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allJasa as $item)
                                        <tr class="d-flex mt-2">
                                            @if($item->status !== "Pasien" && $item->status !== "Admin")
                                            <!-- Checkbox -->
                                            <td scope="row" class="col-md-1 col-sm-2 col-2">
                                                <input type="checkbox" class="checkbox-rounded" id="jasa{{ $item->id }}" name="jasa[]" value="{{ $item->id }}" @foreach($jasa as $item2) @if($item->id == $item2->id_status_jasa)
                                                checked="checked"
                                                @endif
                                                @endforeach
                                                onclick="showHarga('{{ $item->id }}')"/>
                                            </td>

                                            <!-- Jasa -->
                                            <td scope="row" class="col-md-2 col-sm-5 col-5">{{ $item->status }}</td>

                                            <!-- Harga -->
                                            <!-- <td class="col-md-2 col-sm-5 col-5">Rp @currency($item->harga)</td> -->
                                            <td class="col-md-2 col-sm-5 col-5">
                                                <input type="number" name="harga[]" id="harga{{ $item->id }}" placeholder="Masukkan harga" @if($jasa->isEmpty())
                                                style="display: none;"
                                                @else
                                                @php $ada = false; @endphp
                                                @foreach($jasa as $item2)
                                                @if($item->id == $item2->id_status_jasa)
                                                value="{{ $item2->harga }}"
                                                @php $ada = true; @endphp
                                                @endif
                                                @endforeach
                                                @if($ada == true)
                                                style="display: block;"
                                                @else
                                                style="display: none;"
                                                @endif
                                                @endif
                                                >
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4 ms-3" id="btn-edit-kecil">Ubah</button>

            </form>
        </div>
    </div>

</x-admin-layout>
<script>
    function showHarga(id) {
        var jasa = document.getElementById("jasa" + id)
        var harga = document.getElementById("harga" + id)
        if (jasa.checked == true) {
            harga.style.display = "block"
            harga.value = ""
        } else if (jasa.checked == false) {
            harga.style.display = "none"
            harga.value = ""
        }
    }
</script>