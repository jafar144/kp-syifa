<x-admin-layout :title="'Update Staff Medis'">

    <div class="container">
        <div class="py-5">

            @if (session()->has('info'))
            <div class="alert alert-success">
                {{ session()->get('info') }}
            </div>
            @endif

            <!-- Header -->
            <a href="{{ url('/detailStaff/'.$staff->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Edit Staff Medis</h3>

            <form action="{{ url('daftarStaff/update/'.$staff->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

                <!-- Data Staff Medis -->
                <div class="row mt-5">
                    <div class="col-lg-5 ">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Data Staff Medis</div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <div class="montserrat-bold mt-3">NIK</div>
                                    <div class="montserrat-bold" style="margin-top: 21px;">Nama</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Jenis Kelamin</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Status</div>
                                    <div class="montserrat-bold" style="margin-top: 21px;">Email</div>
                                    <div class="montserrat-bold" style="margin-top: 22px;">Nomor Telepon</div>
                                    <div class="montserrat-bold" style="margin-top: 20px;">Alamat</div>
                                    <div class="montserrat-bold" style="margin-top: 38px;">Aktif</div>
                                </div>
                                <div class="col-lg-8">

                                    <!-- NIK Staff -->
                                    <div class="form-group">
                                        <input type="text" name="NIK" id="NIK" placeholder="Masukkan NIK" class="form-control my-2" value="{{ old('NIK') ?? $staff->NIK }}">
                                        @error('NIK')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Nama Staff -->
                                    <div class="form-group">
                                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama" class="form-control my-2" value="{{ old('nama') ?? $staff->nama}}">
                                        @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Jenis Kelamin Staff -->
                                    <div class="form-group">
                                        <select class="form-control select2 my-2" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="" hidden>Jenis Kelamin</option>
                                            <option value="P"
                                                @if($staff->jenis_kelamin == "P")
                                                selected = "selected"
                                                @endif
                                                > Perempuan </option>
                                            <option value="L">Laki-Laki</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status Staff -->
                                    <div class="form-group">
                                        <select class="form-control select2 my-2" name="status" id="status">
                                            <option value="" hidden>Status</option>
                                            @foreach($statusStaff as $item)
                                            <option value="{{ $item->id }}" 
                                                @if ($item->id == $staff->status)
                                                selected = "selected"
                                                @endif
                                                > {{ $item->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email Staff -->
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" placeholder="Masukkan email" class="form-control my-2" value="{{ old('email') ?? $staff->email }}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Nomor Telepon Staff -->
                                    <div class="form-group">
                                        <input type="text" name="notelp" id="notelp" placeholder="Masukkan nomor telpon" class="form-control my-2" value="{{ old('notelp') ?? $staff->notelp}}">
                                        @error('notelp')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat Staff -->
                                    <div class="form-group">
                                        <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control my-2" value="{{ old('alamat') ?? $staff->alamat}}">
                                        @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Aktif -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch" name="is_active" @if($staff->is_active == "Y")
                                        checked
                                        @endif />
                                        <label class="toggle" for="switch">Toggle</label>
                                    </div>

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