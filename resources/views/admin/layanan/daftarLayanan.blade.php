<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Layanan</h3>
                <div class="search-box ms-auto mt-auto justify-content-end d-inline">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" id="search" name="search" placeholder="Cari Layanan ...">
                </div>
            </div>

            <form action="{{ url('daftarLayanan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-start mt-3">
                    <div class="d-inline me-4">
                        <label for="show" class="my-2 color-abu-tuo" style="font-size: smaller;">Tampil ?</label>
                        <select class="form-select" name="show" id="show" style="width: fit-content;">
                            <option disabled value>Pilih status staff</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif> all </option>
                            <option value="Y" @if ($reqselected[0]=="Y" ) selected="selected" @endif>Y</option>
                            <option value="T" @if ($reqselected[0]=="T" ) selected="selected" @endif>T</option>

                        </select>
                        @error('show')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                    </div>
                    <div class="d-inline justify-content-end ms-auto">
                        <a href="{{ url('/daftarLayanan/addView') }}" class="btn btn-primary me-5 mt-4">Tambah Layanan</a>
                    </div>
                </div>

            </form>
            <table class="table table-borderless mt-5">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Pakai Foto</th>
                        <th scope="col">Tampil</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($layanan as $value)
                    <tr class="text-center montserrat-bold">
                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti nama_panjang">{{ $value->nama_layanan }}</td>

                        <!-- Pakai Foto Layanan -->
                        @if($value->use_foto == 'Y')
                        <td class="text-success"><i class="fa-regular fa-circle-check fa-xl"></i></td>
                        @else
                        <td class="text-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>
                        @endif

                        <!-- Tampilkan Layanan -->
                        @if($value->show == 'Y')
                        <td style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>
                        @else
                        <td class="text-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>
                        @endif

                        <td><a href="{{ url('/detailLayanan/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tbody id="search_list">
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if (query != "") {
                $('.alldata').hide();
                $('#search_list').show();
                $.ajax({
                    url: "daftarLayanan/search",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#search_list').html(data);
                    }
                });
            } else {
                $('.alldata').show();
                $('#search_list').hide();
            }
        });
    });
</script>