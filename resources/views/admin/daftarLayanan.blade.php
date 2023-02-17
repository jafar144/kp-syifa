<x-admin-layout>

    <div class="container">
        <div class="py-5">
            <h3 class="montserrat-extra text-start text-shadow">Daftar Layanan</h3><hr>
            filter <br><hr>
            
            <hr>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-center montserrat-med">
                        <th scope="col">No</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Use foto?</th>
                        <th scope="col">Tampil</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($layanan as $value)
                    <tr class="text-center montserrat-bold">
                        
                    <td class="color-inti" scope="row">{{ $loop->iteration }}</td>
                        <td class="color-inti">{{ $value->nama_layanan }}</td>
                        <td class="color-inti">{{ $value->deskripsi }}</td>
                        <td class="color-inti">{{ $value->use_foto }}</td>
                        <td class="color-inti">{{ $value->show }}</td>
                        <td>Detail</td>
                       
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>