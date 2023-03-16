<x-admin-layout>

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStatusStaff') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Status Staff Medis</h3>

            <!-- Status Staff Medis -->
            <div class="row mt-5">
                <div class="col-lg-5 ">
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Status Staff Medis</div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="montserrat-bold">Kode Status</div>
                                <div class="montserrat-bold mt-2">Status</div>
                                <div class="montserrat-bold mt-2">Tanggal Dibuat</div>
                                <div class="montserrat-bold mt-2">Terakhir Update</div>
                                <div class="montserrat-extra mt-5 {{ $statususer->is_active }}-detail text-center">&nbsp; {{ $statususer->status_active($statususer->is_active) }}</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="montserrat-extra">: &nbsp; {{ $statususer->id }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $statususer->status }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $statususer->getTanggalWithJam($statususer->created_at) }}</div>
                                <div class="montserrat-extra mt-2">: &nbsp; {{ $statususer->getTanggalWithJam($statususer->updated_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/statusUser/updateView/'.$statususer->id) }}" class="btn btn-success mt-4 ms-3" id="btn-edit-kecil">Edit</a>

        </div>
    </div>

</x-admin-layout>