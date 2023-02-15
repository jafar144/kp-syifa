<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Pesanan</h3><hr>
            filter <br><hr>
            <form action="{{ url('pesananAdmin') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_status_layanan">Status layanan</label>
                <select  name="id_status_layanan" id="id_status_layanan">
                    <option disabled value>Pilih status layanan</option>
                    <option value="all" 
                        @if ($reqselected[0] == "all")
                            selected="selected"
                        @endif
                    > all </option>
                    
                    @foreach($statuspesanan as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id == $reqselected[0])
                            selected="selected"
                        @endif
                    > {{ $item->status }}</option>

                    @endforeach
                    
                </select>
                @error('id_status_layanan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_layanan">layanan</label>
                <select  name="id_layanan" id="id_layanan">
                    <option disabled value>Pilih layanan</option>
                    <option value="all" 
                        @if ($reqselected[1] == "all")
                            selected="selected"
                        @endif
                    > all </option>
                    
                    @foreach($layanans as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id == $reqselected[1])
                            selected="selected"
                        @endif
                        > {{ $item->nama_layanan }}</option>

                    @endforeach
                    
                </select>
                @error('id_layanan')
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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pesanan as $value)
                    <tr class="text-center montserrat-bold">
                        
                    <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->user_pasien->NIK }}</td>
                        <td class="color-inti">{{ $value->user_pasien->nama }}</td>
                        <td class="color-abu-tuo">{{ $value->created_at }}</td>
                        <td class="color-inti">{{ $value->layanan->nama_layanan }}</td>
                        <td>{{ $value->status_layanan->status }}</td>
                        <td>Detail</td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>