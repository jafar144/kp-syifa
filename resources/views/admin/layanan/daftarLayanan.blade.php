<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow pt-4">Daftar Layanan</h3>
            <div class="search-box ms-auto mt-auto">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="search" name="search" placeholder="Cari Layanan ...">
            </div>
            <a href="{{ url('/daftarLayanan/addView') }}" class="btn btn-primary">+</a>
            <hr> 
            filter <br><hr>
            
            <form action="{{ url('daftarLayanan') }}" method="post" enctype="multipart/form-data">
            @csrf

                <label for="show">is show?</label>
                <select  name="show" id="show">
                    <option disabled value>Pilih status staff</option>
                    <option value="all"
                        @if ($reqselected[0] == "all")
                            selected="selected"
                        @endif> all </option>
                    <option value="Y"
                        @if ($reqselected[0] == "Y")
                            selected="selected"
                        @endif>Y</option>
                        <option value="T"
                        @if ($reqselected[0] == "T")
                            selected="selected"
                        @endif>T</option>
                    
                </select>
                @error('show')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            <button type="submit" class="btn btn-success mt-3" id="pesan-btn">apply</button>

            </form><hr>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Use foto?</th>
                        <th scope="col">Tampil</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                @foreach($layanan as $value)
                    <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->nama_layanan }}</td>
                        <td class="color-inti">{{ $value->use_foto }}</td>
                        <td class="color-inti">{{ $value->show }}</td>
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