<x-admin-layout :title="'Update Pasien'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/detailPasien/'.$pasien->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 mb-5 d-inline">Edit Pasien</h3>

            <div class="mt-4">
                @if($errors->any())
                {!! implode('', $errors->all('
                <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                ')) !!}
                @endif
            </div>

            <form action="{{ url('daftarPasien/update/'.$pasien->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

                <!-- Data Pasien -->
                <div class="row mt-5">
                    <div class="col-lg-7">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Pasien</div>
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
                                                        <input type="text" name="NIK" id="NIK" placeholder="Masukkan NIK" onKeyPress="if(this.value.length==16) return false;" min="16" class="form-control" value="{{ old('NIK') ?? $pasien->NIK }}">
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
                                                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama" class="form-control" value="{{ old('nama') ?? $pasien->nama}}">
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
                                                            <option value="P" 
                                                                @if($pasien->jenis_kelamin == "P")
                                                                selected = "selected"
                                                                @endif
                                                                > Perempuan </option>
                                                            <option value="L"
                                                                @if($pasien->jenis_kelamin == "L")
                                                                selected = "selected"
                                                                @endif
                                                                > Laki-Laki</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Email</div>
                                                </td>
                                                <td>
                                                    <!-- Email Staff -->
                                                    <div class="form-group">
                                                        <input type="text" name="email" id="email" placeholder="Masukkan email" class="form-control" value="{{ old('email') ?? $pasien->email }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Nomor Telepon</div>
                                                </td>
                                                <td>
                                                    <!-- Nomor Telepon Staff -->
                                                    <div class="form-group">
                                                        <input type="text" name="notelp" id="notelp" placeholder="Masukkan nomor telpon" class="form-control" value="{{ old('notelp') ?? $pasien->notelp}}">
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

                <button type="submit" class="btn btn-success mt-4 ms-3" id="pesan-btn">Update</button>
            </form>

        </div>
    </div>

</x-admin-layout>