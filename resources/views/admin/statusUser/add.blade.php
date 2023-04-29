<x-admin-layout :title="'Tambah Status Staff'">

    <div class="container">
        <div class="py-5">

            <!-- Header -->
            <a href="{{ url('/daftarStatusStaff') }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 mb-5 d-inline">Tambah Status Staff Medis</h3>

            @if (session()->has('info'))
            <div class="alert alert-success">
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

            <form action="{{ url('daftarStatusStaff/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Status Staff Medis -->
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="shadow-tipis rounded-card pt-3 pb-4 px-3 mx-2">
                            <div class="d-flex">
                                <div class="montserrat-extra text-start color-inti" style="font-size: larger;">Status Staff Medis</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-12">
                                    <table class="table table-borderless mt-4">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Kode Status</div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="id" id="id" placeholder="Masukkan Kode Status Staff" onkeypress="validateInput(event)" class="form-control" value="{{ old('id') }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Status</div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="status" id="status" placeholder="Masukkan Status Staff" onkeypress="validateInput(event)" class="form-control" value="{{ old('status') }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-4 montserrat-bold">Aktif</div>
                                                </td>
                                                <td>
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
<script>  
    function validateInput(event) {
        const key = event.key;
        if (key === "|") {
        event.preventDefault();
        }
    }
</script>