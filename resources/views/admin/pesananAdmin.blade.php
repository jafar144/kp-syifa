<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Pesanan</h3><hr>
            filter <br><hr>
            <form action="{{ url('pesananAdmin/filter') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_status_layanan">Status layanan</label>
                <select  name="id_status_layanan" id="id_status_layanan">
                    <option disabled value>Pilih status layanan</option>
                    
                    @foreach($statuspesanan as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id == 'M')
                            selected="selected"
                        @endif
                    > {{ $item->status }}</option>

                    @endforeach
                    
                </select>
                @error('id_status_layanan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-3" id="pesan-btn">apply</button>

            </form><hr>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center montserrat-bold">
                        @foreach($pesanan as $value)
                        <td class="color-inti" scope="row">{{ $value->id }}</td>
                        <td class="color-inti">{{ $value->user_pasien->NIK }}</td>
                        <td class="color-inti">{{ $value->user_pasien->nama }}</td>
                        <td class="color-abu-tuo">{{ $value->created_at }}</td>
                        <td class="color-inti">{{ $value->layanan->nama_layanan }}</td>
                        <td>{{ $value->status_layanan->status }}</td>
                        <td>Detail</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>