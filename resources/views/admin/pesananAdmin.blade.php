<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow pt-4">Pesanan</h3>
            <form action="{{ url('pesananAdmin') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="d-flex justify-content-start">
                    <div class="d-inline me-4">
                        <label for="id_status_layanan"></label>
                        <select class="form-select" name="id_status_layanan" id="id_status_layanan" style="width: fit-content;">
                            <option disabled value>Pilih status layanan</option>
                            <option value="all" @if ($reqselected[0]=="all" ) selected="selected" @endif> all </option>

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
                        <label for="id_layanan"></label>
                        <select class="form-select" name="id_layanan" id="id_layanan" style="width: fit-content;">
                            <option disabled value>Pilih layanan</option>
                            <option value="all" @if ($reqselected[1]=="all" ) selected="selected" @endif> all </option>

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
                        <label for="status_pembayaran"></label>
                        <select class="form-select" name="status_pembayaran" id="status_pembayaran" style="width: fit-content;">
                            <option value="all" @if ($reqselected[2]=="all" ) selected="selected" @endif> all </option>
                            <option value="T" @if ($reqselected[2]=="T" ) selected="selected" @endif> Belum Lunas </option>
                            <option value="Y" @if ($reqselected[2]=="Y" ) selected="selected" @endif> Lunas </option>
                        </select>
                        @error('status_pembayaran')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mt-3" id="pesan-btn">apply</button>
                    </div>
                </div>
            </form>
            <hr>
            <table class="table table-borderless">
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
                <tbody>
                    @foreach($pesanan as $value)
                    <tr class="text-center montserrat-bold">

                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->user_pasien->NIK }}</td>
                        <td class="color-inti nama_panjang">{{ $value->user_pasien->nama }}</td>
                        <td class="color-abu-tuo">{{ $value->created_at }}</td>
                        <td class="color-inti">{{ $value->layanan->nama_layanan }}</td>
                        <td><div class="d-inline-flex status_chip">{{ $value->status_layanan->status }}</div></td>
                        <td><button type="button" class="btn btn-success" id="pesan-btn">Detail</button></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>