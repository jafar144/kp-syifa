<x-admin-layout :title="'Detail Status Staff'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStatusStaff') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Detail Status Staff Medis</h3>

            <!-- Status Staff Medis -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                        <div class="d-flex">
                            <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Status Staff Medis</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <table class="table table-borderless mt-4">
                                    <tbody>
                                        <tr class="montserrat-bold ">
                                            <td>Kode Status</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $statususer->id }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>Status</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $statususer->status }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>Tanggal Dibuat</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $statususer->getTanggalWithJam($statususer->created_at) }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>Terakhir Update</td>
                                            <td>:</td>
                                            <td class="montserrat-extra color-abu">{{ $statususer->getTanggalWithJam($statususer->updated_at) }}</td>
                                        </tr>
                                        <tr class="montserrat-bold ">
                                            <td>
                                                <div class="montserrat-extra color-abu {{ $statususer->is_active }}-detail text-center mt-4">&nbsp; {{ $statususer->status_active($statususer->is_active) }}</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/statusUser/updateView/'.$statususer->id) }}" class="btn btn-success mt-4 ms-3" id="btn-edit-kecil">Edit</a>

        </div>
    </div>

</x-admin-layout>