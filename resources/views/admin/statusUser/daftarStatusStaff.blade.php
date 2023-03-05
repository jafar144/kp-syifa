<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow pt-4">Daftar Status Staff</h3>
            <div class="search-box ms-auto mt-auto">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" id="search" name="search" placeholder="Cari Status ...">
            </div>
            filter <br><hr>
            
            <hr>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($statusStaff as $value)
                        <tr class="text-center montserrat-bold">                            
                            <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                            <td class="color-inti">{{ $value->id }}</td>
                            <td class="color-inti">{{ $value->status }}</td>
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
                    url: "daftarStatusStaff/search",
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