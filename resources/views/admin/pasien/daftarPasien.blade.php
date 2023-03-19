<x-admin-layout :title="'Daftar Pasien'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex mb-5">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Pasien</h3>
                <div class="search-box ms-auto mt-auto justify-content-end d-inline">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" id="search" name="search" placeholder="Cari Pasien ...">
                </div>
            </div>
            <div class="d-flex justify-content-end ms-auto">
                <a href="/pasien-export" class="btn btn-outline-success mt-4 me-5 remove-underline">Export Excel</a>
            </div>
            <table class="table table-borderless mt-3">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No.Tel / WA</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($pasien as $value)
                        <tr class="text-center montserrat-bold">                        
                            <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                            <td class="color-inti">{{ $value->NIK }}</td>
                            <td class="color-inti nama_panjang">{{ $value->nama }}</td>
                            <td class="color-abu-tuo">+{{ $value->phoneNumber($value->notelp) }}</td>
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