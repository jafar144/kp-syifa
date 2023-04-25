<x-admin-layout :title="'Update Status Staff'">

    <div class="container">
        <div class="py-5">

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

            <!-- Header -->
            <a href="{{ url('/statusUser/detail/'.$statususer->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
            <h3 class="montserrat-extra text-start text-shadow pt-4 d-inline">Edit Status Staff Medis</h3>

            <form action="{{ url('statusUser/update/'.$statususer->id) }}" method="post" enctype="multipart/form-data">
                @method("PATCH")
                @csrf

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
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Kode Status</div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input disabled type="text" class="form-control" value="{{ $statususer->id }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-2 montserrat-bold">Status</div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="status" id="status" placeholder="Masukkan Status Staff" class="form-control" value="{{ old('status') ?? $statususer->status }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="mt-4 montserrat-bold">Aktif</div>
                                                </td>
                                                <td>
                                                    <div class="form-group mt-3">
                                                        <input type="checkbox" id="switch" name="is_active" @if($statususer->is_active == "Y")
                                                        checked
                                                        @endif />
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

                <button type="submit" class="btn btn-success mt-4 ms-3" id="pesan-btn">Update</button>
            </form>

        </div>
    </div>

</x-admin-layout>