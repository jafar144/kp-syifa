<x-admin-layout :title="'Daftar Layanan'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Layanan</h3>
                <div class="ms-auto mt-auto justify-content-end d-inline">
                <a href="{{ url('/daftarLayanan/addView') }}" class="btn btn-primary me-5 mt-4" id="pesan-btn-sedang">
                            <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Layanan
                        </a>
                </div>
            </div>

            <form action="{{ url('daftarLayanan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-start mt-3">
                    <div class="d-inline me-4">
                        <label for="show" class="my-2 color-abu-tuo" style="font-size: smaller;">Tampil ?</label>
                        <select class="form-select" name="show" id="show" style="width: fit-content;">
                            <option disabled value>Pilih status staff</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif>Semua</option>
                            <option value="Y" @if ($reqselected[0]=="Y" ) selected="selected" @endif>Ya</option>
                            <option value="T" @if ($reqselected[0]=="T" ) selected="selected" @endif>Tidak</option>

                        </select>
                        @error('show')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                    </div>
                    <div class="search-box d-inline justify-content-end ms-auto">
                        
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search mt-4" id="search" name="search" placeholder="Cari Layanan ...">
                    </div>
                </div>

            </form>
            <div class="d-flex justify-content-end ms-auto">
                <a href="/layanan-export" class="btn btn-outline-success mt-4 me-5 remove-underline">Export Excel (layanan)</a>
                <a href="/hargalayanan-export" class="btn btn-outline-success mt-4 me-5 remove-underline">Export Excel (harga layanan)</a>
            </div>
            <table class="table table-borderless table-responsive mt-5">
                <thead>
                    <tr class="montserrat-med">
                        <th class="col-md-1 text-center" scope="col">No</th>
                        <th class="col-md-4" scope="col">Layanan</th>
                        <th class="col-md-2 text-center" scope="col">Pakai Foto</th>
                        <th class="col-md-2 text-center" scope="col">Tampil</th>
                        <th class="col-md-1 text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($layanan as $key => $value)
                    <tr class="montserrat-bold">
                        <td class="color-inti text-center vertical_space" scope="row">{{ $layanan->firstItem() + $key }}</td>
                        <td class="color-inti text-start nama_panjang vertical_space" style="width: fit-content;">{{ $value->nama_layanan }}</td>

                        <!-- Pakai Foto Layanan -->
                        @if($value->use_foto == 'Y')
                        <td class="text-center vertical_space" style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>
                        @else
                        <td class="text-danger text-center vertical_space"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>
                        @endif

                        <!-- Tampilkan Layanan -->
                        @if($value->show == 'Y')
                        <td class="text-center vertical_space" style="color: #07DA63;"><i class="fa-regular fa-circle-check fa-xl"></i></td>
                        @else
                        <td class="text-danger text-center vertical_space"><i class="fa-regular fa-circle-xmark fa-xl"></i></td>
                        @endif

                        <td class="text-center vertical_space"><a href="{{ url('/detailLayanan/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tbody id="search_list">
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $layanan->links() }}
            </div>
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