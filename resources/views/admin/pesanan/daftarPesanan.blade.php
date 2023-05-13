<x-admin-layout :title="'Daftar Pesanan'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Pesanan</h3>
            </div>

            <div class="d-flex justify-content-start">
                <form action="{{ url('daftarPesanan') }}" method="post" enctype="multipart/form-data" class="d-inline mt-2">
                    @csrf

                    <div class="d-flex justify-content-start mt-3">
                        <div class="d-inline me-4">
                            <label for="id_status_pesanan" class="my-2 color-abu-tuo" style="font-size: smaller;">Status Pesanan</label>
                            <select class="form-select" name="id_status_pesanan" id="id_status_pesanan" style="width: fit-content;">
                                <option disabled value>Pilih status layanan</option>
                                <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif>Semua</option>

                                @foreach($statuspesanan as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $reqselected[0])
                                    selected="selected"
                                    @endif
                                    > {{ $item->status }}</option>

                                @endforeach

                            </select>
                            @error('id_status_pesanan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-inline me-4">
                            <label for="id_layanan" class="my-2 color-abu-tuo" style="font-size: smaller;">Layanan</label>
                            <select class="form-select" name="id_layanan" id="id_layanan" style="width: fit-content;">
                                <option disabled value>Pilih layanan</option>
                                <option value="all" @if ($reqselected[1]=="all" ) selected="selected" @endif>Semua</option>

                                @foreach($layanans as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $reqselected[1])
                                    selected="selected"
                                    @endif
                                    > {{ $item->nama_layanan }}</option>

                                @endforeach

                            </select>
                            @error('id_layanan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-inline me-4">
                            <label for="status_pembayaran" class="my-2 color-abu-tuo" style="font-size: smaller;">Status Pembayaran</label>
                            <select class="form-select" name="status_pembayaran" id="status_pembayaran" style="width: fit-content;">
                                <option value="all" @if ($reqselected[2]=="all" ) selected="selected" @endif>Semua</option>
                                <option value="T" @if ($reqselected[2]=="T" ) selected="selected" @endif> Belum Lunas </option>
                                <option value="Y" @if ($reqselected[2]=="Y" ) selected="selected" @endif> Lunas </option>
                            </select>
                            @error('status_pembayaran')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-end">
                            <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                        </div>

                    </div>
                </form>
                <div class="search-box d-inline justify-content-end ms-auto">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search mt-5" id="search" name="search" placeholder="Cari Pesanan ...">
                </div>
            </div>

            <form action="pesanan-export" method="post" enctype="multipart/form-data" class="my-4">
                @csrf
                <div class="d-flex justify-content-start me-auto">

                    <div class="form-group me-4">
                        <label for="from" class="my-2 color-abu-tuo" style="font-size: smaller;">from</label>
                        <input type="date" name="from" id="from" class="form-control me-4 remove-underline" value="{{ old('from') }}">
                        @error('from')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group me-4">
                        <label for="to" class="my-2 color-abu-tuo" style="font-size: smaller;">to</label>
                        <input type="date" name="to" id="to" class="form-control me-4 remove-underline" value="{{ old('to') }}">
                        @error('to')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-end">
                        <button type="submit" class="mt-4 me-4" id="export-excel">Export</button>
                    </div>
                </div>
            </form>

            <table class="table table-borderless" id="myTable">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($pesanan as $value)
                    <tr class="text-center montserrat-bold">
                        <td class="color-inti vertical_space" scope="row"></td>
                        <td class="color-inti vertical_space"><a href="{{ url('/detailPasien/'.$value->id_pasien) }}" class="remove_underline">{{ $value->user_pasien->NIK }}</a></td>
                        <td class="color-inti nama_panjang vertical_space"><a href="{{ url('/detailPasien/'.$value->id_pasien) }}" class="remove_underline">{{ $value->user_pasien->nama }}</a></td>
                        <td class="color-abu-tuo vertical_space">{{ $value->getTanggalWithJam($value->created_at) }}</td>
                        <td class="color-inti nama_panjang vertical_space"><a href="{{ url('/detailLayanan/'.$value->id_layanan) }}" class="remove_underline">{{ $value->layanan->nama_layanan }}</a></td>
                        <td>
                            <div class="d-inline-flex status_chip vertical_space">{{ $value->status_pesanan->status }}</div>
                        </td>
                        <td><a href="{{ url('/detailPesanan/'.$value->id) }}" class="btn btn-success vertical_space" id="pesan-btn">Detail</a></td>
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
                targets: [0, 1, 2, 3, 4, 5, 6]
            },
            {
                "searchable": false,
                "targets": [0, 3, 4, 5]
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
    $('#myTable tbody').on("DOMSubtreeModified", function() {
        const statusChip = document.querySelectorAll('.status_chip');
        statusChip.forEach(status => {
            if (status.innerHTML == 'Menunggu') status.classList.add('Menunggu');
            else if (status.innerHTML == 'Selesai') status.classList.add('Selesai');
            else if (status.innerHTML == 'Berlangsung') status.classList.add('Berlangsung');
            else if (status.innerHTML == 'Ditolak') status.classList.add('Ditolak');
            else if (status.innerHTML == 'Dibatalkan') status.classList.add('Dibatalkan');
        })
    });
</script>