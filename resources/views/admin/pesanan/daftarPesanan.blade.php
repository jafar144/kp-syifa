<x-admin-layout :title="'Daftar Pesanan'">

    <div class="container">
        <div class="py-5">
            <div class="d-flex">
                <h3 class="montserrat-extra text-start text-shadow pt-4 justify-content-start d-inline">Pesanan</h3>
                <div class="search-box ms-auto mt-auto justify-content-end d-inline">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" id="search" name="search" placeholder="Cari Pesanan ...">
                </div>
            </div>

            <form action="{{ url('daftarPesanan') }}" method="post" enctype="multipart/form-data">
            @csrf

                <div class="d-flex justify-content-start mt-3">
                    <div class="d-inline me-4">
                        <label for="id_status_layanan" class="my-2 color-abu-tuo" style="font-size: smaller;">Status Pesanan</label>
                        <select class="form-select" name="id_status_layanan" id="id_status_layanan" style="width: fit-content;">
                            <option disabled value>Pilih status layanan</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif>Semua</option>

                            @foreach($statuspesanan as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $reqselected[0])
                                selected="selected"
                                @endif
                                > {{ $item->status }}</option>

                            @endforeach

                        </select>
                        @error('id_status_layanan')
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
                    <div class="d-flex align-items-end ">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">Apply</button>
                    </div>
                </div>
            </form>

            <form action="pesanan-export" method="post" enctype="multipart/form-data">
            @csrf                
                <div class="d-flex justify-content-end ms-auto">
                    <label for="from" class="my-2 color-abu-tuo" style="font-size: smaller;">from</label>
                    <input type="date" name="from" id="from" placeholder="from" class="btn btn-outline-success mt-4 me-4 remove-underline" value="{{ old('from') }}">
                    @error('from')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="to" class="my-2 color-abu-tuo" style="font-size: smaller;">to</label>
                    <input type="date" name="to" id="to" placeholder="to" class="btn btn-outline-success mt-4 me-4 remove-underline" value="{{ old('to') }}">
                    @error('to')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-outline-success mt-4 me-4">Export Excel</button>
                </div>
            </form>  
                      
            <table class="table table-borderless mt-4">
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
                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti"><a href="{{ url('/detailPasien/'.$value->id_pasien) }}" class="remove_underline">{{ $value->user_pasien->NIK }}</a></td>
                        <td class="color-inti nama_panjang"><a href="{{ url('/detailPasien/'.$value->id_pasien) }}" class="remove_underline">{{ $value->user_pasien->nama }}</a></td>
                        <td class="color-abu-tuo">{{ $value->getTanggalWithJam($value->created_at) }}</td>
                        <td class="color-inti"><a href="{{ url('/detailLayanan/'.$value->id_layanan) }}" class="remove_underline">{{ $value->layanan->nama_layanan }}</a></td>
                        <td>
                            <div class="d-inline-flex status_chip">{{ $value->status_layanan->status }}</div>
                        </td>
                        <td><a href="{{ url('/detailPesanan/'.$value->id) }}" class="btn btn-success" id="pesan-btn">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tbody id="search_list">
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $pesanan->links() !!}
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
                    url: "daftarPesanan/search",
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