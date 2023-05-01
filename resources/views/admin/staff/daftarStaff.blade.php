<x-admin-layout :title="'Daftar Staff Medis'">

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
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Staff Medis</h3>
                <div class="ms-auto mt-auto justify-content-end d-inline">
                    <a href="{{ url('/daftarStaff/addView') }}" class="btn btn-primary me-5" id="pesan-btn-sedang">
                        <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Staff
                    </a>
                </div>
            </div>

            <form action="{{ url('daftarStaff') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="d-flex justify-content-start mt-3">
                    <div class="d-inline me-4">
                        <label for="status_staff" class="my-2 color-abu-tuo" style="font-size: smaller;">Status staff</label>
                        <select class="form-select" name="status_staff" id="status_staff" style="width: fit-content;">
                            <option disabled value>Pilih status staff</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif>Semua</option>

                            @foreach($statusStaff as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $reqselected[0])
                                selected="selected"
                                @endif> {{ $item->status }}
                            </option>
                            @endforeach

                        </select>
                        @error('status_staff')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline me-4">
                        <label for="is_active" class="my-2 color-abu-tuo" style="font-size: smaller;">Aktif ?</label>
                        <select class="form-select" name="is_active" id="is_active" style="width: fit-content;">
                            <option value="all" @if ($reqselected[1]=="all" ) selected="selected" @endif>All </option>
                            <option value="Y" @if ($reqselected[1]=="Y" ) selected="selected" @endif>Aktif</option>
                            <option value="T" @if ($reqselected[1]=="T" ) selected="selected" @endif>Tidak Aktif</option>

                        </select>
                        @error('is_active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-end ">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                    </div>
                    <div class="search-box d-inline justify-content-end ms-auto">
                        <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="input-search mt-4" id="search" name="search" placeholder="Cari Staff ...">
                    </div>
                </div>

            </form>

            <div class="d-flex justify-content-start me-auto mt-5 mb-4">
                <a href="/staff-export" class="ms-2 remove-underline" id="export-excel">EXPORT</a>
            </div>

            <table class="table table-borderless mt-4" id="myTable">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aktif ?</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($staff as $key => $value)
                    <tr class="text-center montserrat-bold">
                        <td class="color-inti vertical_space" scope="row"></td>
                        <td class="color-inti nama_panjang vertical_space">{{ $value->nama }}</td>
                        <td class="color-inti vertical_space">{{ $value->NIK }}</td>
                        <td class="color-abu-tuo nama_panjang vertical_space">{{ $value->status_user->status }}</td>
                        <td>
                            <div class="{{ $value->is_active }} vertical_space">{{ $value->status_active($value->is_active) }}</div>
                        </td>
                        <td class="vertical_space"><a href="{{ url('/detailStaff/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>
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
                targets: [0, 1, 2, 3, 4, 5]
            },
            {
                "searchable": false,
                "targets": [0, 3, 4]
            }
        ]
    });

    $(document).ready(function() {
        table.draw();

        $('#search').keyup(function() {
            table.search($(this).val()).draw();
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