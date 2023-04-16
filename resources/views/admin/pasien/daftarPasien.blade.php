<x-admin-layout :title="'Daftar Pasien'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex mb-5">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Pasien</h3>
                <div class="search-box ms-auto mt-auto justify-content-end d-inline">
                    <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" id="search" name="search" placeholder="Cari Pasien ...">
                </div>
            </div>
            
            <div class="d-flex justify-content-start me-auto mb-4">
                <a href="/pasien-export" class="mt-4 ms-2 remove-underline" id="export-excel">EXPORT</a>
            </div>

            <table class="table table-borderless mt-4" id="myTable">
                <thead>
                    <tr class="montserrat-med">
                        <th class="text-center" id="width-max-content" scope="col">No</th>
                        <th class="" scope="col">Nama</th>
                        <th class="text-center" scope="col">NIK</th>
                        <th class="text-center" scope="col">No.Tel / WA</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($pasien as $value)
                        <tr class="montserrat-bold">                        
                            <td class="color-inti text-center vertical_space" scope="row">{{ $loop->iteration }}</td>
                            <td class="color-inti nama_panjang vertical_space">{{ $value->nama }}</td>
                            <td class="color-inti text-center vertical_space">{{ $value->NIK }}</td>
                            <td class="color-abu-tuo text-center vertical_space">+{{ $value->phoneNumber($value->notelp) }}</td>
                            <td class="text-center vertical_space"><a href="{{ url('/detailPasien/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>                       
                        </tr>                
                    @endforeach               
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>

<style>
    .dataTables_filter {
        display: none;
    }

    table.dataTable thead th {
        border: none;
    }

    table.dataTable tbody td {
        border: none;
    }

    table.dataTable tfoot th {
        border: none;
    }
</style>

<link rel="stylesheet" href="{{ asset('css/search.css') }}">

<script>
    let table = $('#myTable').DataTable({
        paging: true,
        ordering: false,
        info: false,
        searching: true,
        "lengthChange": false,
        "language": {
            "zeroRecords": "Data yang anda cari tidak ditemukan!",
        },
        columnDefs: [{
            className: "dt-head-center",
            targets: [0, 2, 3, 4]
        }]
    });

    $(document).ready(function() {
        table.draw();

        $('#search').keyup(function() {
            table.column(1).search($(this).val()).draw();
        })
    });
</script>
<!-- <script>
    
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
</script> -->