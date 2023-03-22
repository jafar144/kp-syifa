<x-admin-layout :title="'Tambah Status Staff'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStatusUser') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Tambah Status Staff Medis</h3>

            @if (session()->has('info'))
            <div class="alert alert-success">
                {{ session()->get('info') }}
            </div>
            @endif

            <form action="{{ url('daftarStatusStaff/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Status Staff Medis -->
                <div class="row mt-5">
                    <div class="col-lg-5 ">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Status Staff Medis</div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <div class="montserrat-bold mt-1">Kode Status</div>
                                    <div class="montserrat-bold" style="margin-top: 33px;">Status</div>
                                    <div class="montserrat-bold" style="margin-top: 36px;">Aktif</div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <input type="text" name="id" id="id" placeholder="Masukkan Kode Status Staff" class="form-control" value="{{ old('id') }}">
                                        @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="status" id="status" placeholder="Masukkan Status Staff" class="form-control my-2" value="{{ old('status') }}">
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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