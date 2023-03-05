<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow pt-4">Daftar Staff</h3>
            <div class="search-box ms-auto mt-auto">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="search" name="search" placeholder="Cari Staff ...">
            </div>
            
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
                <tbody class="alldata">
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
                <tbody id="search_list">
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<script>
    
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if (query != "") {
                $('.alldata').hide();
                $('#search_list').show();
                $.ajax({
                    url: "daftarStaff/search",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#search_list').html(data);
                    }
                });
            } else {
                $('.alldata').show();
                $('#search_list').hide();
            }
        });
    });
</script>