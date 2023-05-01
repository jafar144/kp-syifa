<x-admin-layout :title="'Daftar Status Staff'">

    <div class="container">

        <div class="z-5 position-absolute ps-5" style="overflow: hidden; left: 25%;">
            @if (session()->has('info'))
            <div class="custom-alert-pocok align-items-center z-5">
                <div class="row">
                    <div class="col-2">
                        <span class="fas fa-exclamation-circle"></span>
                    </div>
                    <div class="col-10">
                        <span class="msg">{{ session()->get('info') }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Status Staff Medis</h3>
                <div class="ms-auto mt-auto justify-content-end d-inline">
                    <a href="{{ url('/daftarStatusStaff/addView') }}" class="btn btn-primary me-5" id="pesan-btn-sedang">
                        <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Status
                    </a>
                </div>
            </div>

            <form action="{{ url('daftarStatusStaff') }}" method="post" enctype="multipart/form-data" class="mb-4">
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
                    <div class="search-box d-inline justify-content-end ms-auto">
                        <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="input-search mt-4" id="search" name="search" placeholder="Cari Status Staff ...">
                    </div>
                </div>

            </form>

            <table class="table table-borderless mt-5" id="myTable">
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
                        <td class="color-inti vertical_space" scope="row"></td>
                        <td class="color-inti vertical_space">{{ $value->id }}</td>
                        <td class="color-inti vertical_space">{{ $value->status }}</td>
                        <td>
                            <div class="{{ $value->is_active }} vertical_space">{{ $value->status_active($value->is_active) }}</div>
                        </td>
                        <td><a href="{{ url('/statusUser/detail/'.$value->id) }}" class="btn btn-success vertical_space" id="pesan-btn">Detail</a></td>
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
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none;
        border-color: white !important;
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
            targets: [0, 1, 2, 3, 4]
        }]
    });

    $(document).ready(function() {
        table.draw();

        $('#search').keyup(function() {
            table.column(2).search($(this).val()).draw();
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
        $('.custom-alert-pocok').addClass("show");
        $('.custom-alert-pocok').removeClass("hide");
        $('.custom-alert-pocok').addClass("showAlert");
        setTimeout(function() {
            $('.custom-alert-pocok').removeClass("show");
            $('.custom-alert-pocok').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.custom-alert-pocok').removeClass("show");
        $('.custom-alert-pocok').addClass("hide");
    });
</script>