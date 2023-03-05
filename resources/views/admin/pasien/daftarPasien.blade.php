<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow pt-4">Daftar Pasien</h3>
            <div class="search-box ms-auto mt-auto">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="search" name="search" placeholder="Cari Pasien ...">
            </div>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($pasien as $value)
                        <tr class="text-center montserrat-bold">                        
                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->NIK }}</td>
                        <td class="color-inti">{{ $value->nama }}</td>
                        <td><a href="{{ url('/detailPasien/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>                       
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
                    url: "daftarPasien/search",
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