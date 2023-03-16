<x-admin-layout>

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/statususer') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Edit Status Staff Medis</h3>

            @if (session()->has('info'))
            <div class="alert alert-success">
                {{ session()->get('info') }}
            </div>
            @endif

            <form action="{{ url('statusUser/update/'.$statususer->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
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
                                    <div class="montserrat-bold">Kode Status</div>
                                    <div class="montserrat-bold mt-4">Status</div>
                                    <div class="montserrat-bold" style="margin-top: 35px;">Aktif</div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="montserrat-extra">: &nbsp; {{ $statususer->id }}</div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="status" id="status" placeholder="Masukkan Status Staff" class="form-control my-2" value="{{ old('status') ?? $statususer->status }}">
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Aktif -->
                                    <div class="form-group mt-4">
                                        <input type="checkbox" id="switch" name="is_active" 
                                        @if($statususer->is_active == "Y")
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