<x-admin-layout>

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarLayanan') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Layanan</h3>
            <div class="row mt-5">
                <div class="col-lg-5 ">
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Staff Medis</div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="montserrat-bold">NIK</div>
                                <div class="montserrat-bold mt-2">Nama</div>
                                <div class="montserrat-bold mt-2">Jenis Kelamin</div>
                                <div class="montserrat-bold mt-2">Status</div>
                                <div class="montserrat-bold mt-2">Email</div>
                                <div class="montserrat-bold mt-2">Tanggal Lahir</div>
                                <div class="montserrat-bold mt-2">Alamat</div>
                                <div class="montserrat-bold mt-4">Status Aktif</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="montserrat-extra">: &nbsp; {{ $staff->NIK }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->nama }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->getJenisKelamin($staff->jenis_kelamin) }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->status_user->status }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->email }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->getTanggal($staff->tanggal_lahir) }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $staff->alamat }}</div>
                                <div class="montserrat-extra mt-4 {{ $staff->is_active }}">: &nbsp; {{ $staff->status_active($staff->is_active) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($harga_layanan != null)
            <table class="table table-borderless table-sm">
                <thead>
                    <tr class="d-flex mt-3">
                        <th scope="col" class="col-md-2 col-sm-6 col-6">Tenaga Medis</th>
                        <th scope="col" class="col-md-2 col-sm-6 col-6">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($harga_layanan as $item)
                    <tr class="d-flex mt-2">
                        <td scope="row" class="col-md-2 col-sm-6 col-6">{{ $item->status_user->status }}</td>
                        <td class="col-md-2 col-sm-6 col-6">Rp @currency($item->harga)</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <a href="{{ url('/daftarLayanan/updateView/'.$layanan->id) }}" class="btn btn-success" id="pesan-btn">Edit</a>

        </div>
    </div>

</x-admin-layout>