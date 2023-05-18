<x-admin-layout :title="'Tambah Staff Medis'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStaff') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 mb-5 d-inline">Tambah Staff Medis</h3>

            <div class="mt-4">
                @if($errors->any())
                {!! implode('', $errors->all('
                <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                ')) !!}
                @endif
            </div>

            <form action="{{ url('daftarStaff/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Data Staff Medis -->
                <div class="row mt-5">
                    <div class="col-lg-7">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Staff Medis</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-borderless mt-4">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">NIK</div>
                                                </td>
                                                <td>
                                                    <!-- NIK Staff -->
                                                    <div class="form-group">
                                                        <input type="number" name="NIK" id="NIK" placeholder="Masukkan NIK" onkeydown="return event.keyCode !== 69" onKeyPress="if(this.value.length==16) return false;" min="16" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Nama</div>
                                                </td>
                                                <td>
                                                    <!-- Nama Staff -->
                                                    <div class="form-group">
                                                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama" class="form-control" >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Jenis Kelamin</div>
                                                </td>
                                                <td>
                                                    <!-- Jenis Kelamin Staff -->
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin">
                                                            <option value="" hidden>Jenis Kelamin</option>
                                                            <option value="P"> Perempuan</option>
                                                            <option value="L"> Laki-Laki</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Status</div>
                                                </td>
                                                <td>
                                                    <!-- Status Staff -->
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="status" id="status">
                                                            <option value="" hidden>Status</option>
                                                            @foreach($statusjasa as $item)
                                                            <option value="{{ $item->id }}"> {{ $item->status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Email</div>
                                                </td>
                                                <td>
                                                    <!-- Email Staff -->
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email" placeholder="Masukkan email" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Nomor Telepon</div>
                                                </td>
                                                <td>
                                                    <!-- Nomor Telepon Staff -->
                                                    <div class="form-group">
                                                        <input type="number" name="notelp" id="notelp" onkeydown="return event.keyCode !== 69" placeholder="Masukkan nomor telpon" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-4">Aktif</div>
                                                </td>
                                                <td>
                                                    <!-- Aktif -->
                                                    <div class="form-group mt-3">
                                                        <input type="checkbox" id="switch" name="is_active">
                                                        <label class="toggle" for="switch">Toggle</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4 ms-2" id="pesan-btn">Tambah</button>
            </form>

        </div>
    </div>

</x-admin-layout>