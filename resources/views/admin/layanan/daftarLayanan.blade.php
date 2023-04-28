<x-admin-layout :title="'Daftar Layanan'">

    <div class="container">

        <div class="ms-auto me-auto ps-5" style="overflow: hidden;">
            @if (session()->has('info'))
            <div class="custom-alert align-items-center">
                <div class="row">
                    <div class="col-2">
                        <span class="fas fa-exclamation-circle"></span>
                    </div>
                    <div class="col-8">
                        <span class="msg">{{ session()->get('info') }}</span>
                    </div>
                    <div class="col-2">
                        <div class="close-btn">
                            <span class="fas fa-times"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

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
                <div class="d-flex  mt-3">
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
                        <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="input-search mt-4" id="search" name="search" placeholder="Cari Layanan ...">
                    </div>
                </div>

            </form>

            <div class="d-flex justify-content-start me-auto mt-5 mb-4">
                <a href="/layanan-export" class="ms-2 remove-underline" id="export-excel">EXPORT LAYANAN</a>
                <a href="/hargalayanan-export" class="ms-4 remove-underline" id="export-excel">EXPORT HARGA LAYANAN</a>
            </div>

            <table class="table table-borderless table-responsive mt-5" id="myTable">
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
                        <td class="color-inti text-center vertical_space" scope="row"></td>
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

    table.dataTable {
        border-color: white !important;
    }

    .pagination {
        background-color: white !important;
        outline: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none;
        border-color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        outline: white !important;
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

    table.on('order.dt search.dt', function() {
        let i = 1;

        table.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();
</script>
<script>
    $(document).ready(function() {
        $('.custom-alert').addClass("show");
        $('.custom-alert').removeClass("hide");
        $('.custom-alert').addClass("showAlert");
        // setTimeout(function() {
        //     $('.custom-alert').removeClass("show");
        //     $('.custom-alert').addClass("hide");
        // }, 5000);
    });
    $('.close-btn').click(function() {
        $('.custom-alert').removeClass("show");
        $('.custom-alert').addClass("hide");
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
</script> -->