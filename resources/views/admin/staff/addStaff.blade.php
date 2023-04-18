<x-admin-layout :title="'Tambah Staff Medis'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStaff') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 mb-5 d-inline">Tambah Staff Medis</h3>

            @if (session()->has('info'))
            <div class="alert alert-success mt-4">
                {{ session()->get('info') }}
            </div>
            @endif

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
                    <div class="col-lg-6 col-md-12">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Staff Medis</div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                    <div class="montserrat-bold mt-3">NIK</div>
                                    <div class="montserrat-bold" style="margin-top: 21px;">Nama</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Jenis Kelamin</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Status</div>
                                    <div class="montserrat-bold" style="margin-top: 21px;">Email</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Nomor Telepon</div>
                                    <div class="montserrat-bold" style="margin-top: 20px;">Alamat</div>
                                    <div class="montserrat-bold" style="margin-top: 38px;">Aktif</div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-6">

                                    <!-- NIK Staff -->
                                    <div class="form-group">
                                        <input type="text" name="NIK" id="NIK" placeholder="Masukkan NIK" class="form-control my-2" onKeyPress="if(this.value.length==16) return false;" min="16" value="{{ old('NIK') }}">
                                    </div>

                                    <!-- Nama Staff -->
                                    <div class="form-group">
                                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama" class="form-control my-2" value="{{ old('nama') }}">
                                    </div>

                                    <!-- Jenis Kelamin Staff -->
                                    <div class="form-group">
                                        <select class="form-control select2 my-2" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="" hidden>Jenis Kelamin</option>
                                            <option value="P">Perempuan</option>
                                            <option value="L">Laki-Laki</option>
                                        </select>
                                    </div>

                                    <!-- Status Staff -->
                                    <div class="form-group">
                                        <select class="form-control select2 my-2" name="status" id="status">
                                            <option value="" hidden>Status</option>
                                            @foreach($statusjasa as $item)
                                            <option value="{{ $item->id }}"> {{ $item->status }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Email Staff -->
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" placeholder="Masukkan email" class="form-control my-2" value="{{ old('email') }}">
                                    </div>

                                    <!-- Nomor Telepon Staff -->
                                    <div class="form-group">
                                        <input type="number" name="notelp" id="notelp" placeholder="Masukkan nomor telpon" class="form-control my-2" value="{{ old('notelp') }}">
                                    </div>

                                    <!-- Alamat Staff -->
                                    <div class="form-group">
                                        <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') }}">
                                    </div>

                                    <!-- Aktif -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch" name="is_active">
                                        <label class="toggle" for="switch">Toggle</label>
                                    </div>

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