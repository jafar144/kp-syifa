<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Daftar Staff</h3><hr>
            filter <br><hr>
            
            <hr>
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