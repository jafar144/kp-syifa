<x-admin-layout :title="'Daftar Status Staff'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Status Staff Medis</h3>
                <div class="search-box ms-auto mt-auto justify-content-end d-inline">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" id="search" name="search" placeholder="Cari Status Staff ...">
                </div>
            </div>

            <form action="{{ url('daftarStatusStaff') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-start mt-3">
                    <div class="d-inline me-4">
                        <label for="aktif" class="my-2 color-abu-tuo" style="font-size: smaller;">Aktif ?</label>
                        <select class="form-select" name="aktif" id="aktif" style="width: fit-content;">
                            <option disabled value>Pilih status staff</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif>Semua</option>
                            <option value="Y" @if ($reqselected[0]=="Y" ) selected="selected" @endif>Aktif</option>
                            <option value="T" @if ($reqselected[0]=="T" ) selected="selected" @endif>Tidak Aktif</option>

                        </select>
                        @error('aktif')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                    </div>
                    <div class="d-inline justify-content-end ms-auto">
                        <a href="{{ url('/daftarStatusStaff/addView') }}" class="btn btn-primary me-5 mt-4">Tambah Status</a>
                    </div>
                </div>

                <table class="table table-borderless mt-5">
                    <thead>
                        <tr class="text-center montserrat-med">
                            <th scope="col">No</th>
                            <th scope="col">Kode Status</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aktif ?</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="alldata">
                        @foreach($statusStaff as $value)
                        <tr class="text-center montserrat-bold">
                            <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                            <td class="color-inti">{{ $value->id }}</td>
                            <td class="color-inti">{{ $value->status }}</td>
                            <td>
                                <div class="{{ $value->is_active }}">{{ $value->status_active($value->is_active) }}</div>
                            </td>
                            <td><a href="{{ url('/statusUser/detail/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>
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
                    url: "daftarStatusStaff/search",
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