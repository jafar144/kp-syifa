<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Daftar Staff</h3><hr>
            filter <br><hr>
            
            <form action="{{ url('daftarStaff') }}" method="post" enctype="multipart/form-data">
            @csrf

                <label for="status_staff">Status staff</label>
                <select  name="status_staff" id="status_staff">
                    <option disabled value>Pilih status staff</option>
                    <option value="all"
                        @if ($reqselected[0] == "all")
                            selected="selected"
                        @endif> all </option>

                    @foreach($statusStaff as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id == $reqselected[0])
                            selected="selected"
                        @endif> {{ $item->status }}</option>
                    @endforeach
                    
                </select>
                @error('status_staff')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            <button type="submit" class="btn btn-success mt-3" id="pesan-btn">apply</button>

            </form><hr>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($staff as $value)
                    <tr class="text-center montserrat-bold">
                        
                    <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->NIK }}</td>
                        <td class="color-inti">{{ $value->nama }}</td>
                        <td class="color-abu-tuo">{{ $value->status_user->status }}</td>
                        <td>Detail</td>
                       
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>