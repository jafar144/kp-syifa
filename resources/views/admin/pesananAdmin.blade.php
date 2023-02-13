<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Pesanan</h3>
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
                        <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->users->NIK }}</td>
                        <td class="color-inti">{{ $value->users->nama }}</td>
                        <td class="color-abu-tuo">{{ $value->created_at }}</td>
                        <td class="color-inti">{{ $value->id_layanan->nama_layanan }}</td>
                        <td>{{ $value->id_status_layanan->status }}</td>
                        <td>Detail</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>