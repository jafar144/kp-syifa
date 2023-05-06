<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">

<x-inti-layout :title="'Buat Pesanan'">

    <div class="container">

        <a href="https://wa.me/628117830717" class="wa-float pt-2" target="_blank">
            <div><i class="fa fa-xl fa-whatsapp my-float"></i> <span><strong> &nbsp; Hubungi Kami</strong></span></div>
        </a>

        <div class="pt-5">
            <div class="pt-5">
                <div class="mt-5">
                    <a href="{{ url('/layanan/'.$layanan->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>
                </div>

                <div class="mt-4">
                    @if($errors->any())
                    {!! implode('', $errors->all('
                    <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                    ')) !!}
                    @endif
                </div>

                <form action="{{ url('pesan/'.$layanan->id) }}" method="post" enctype="multipart/form-data" class="mt-4" id="formTambahPesanan">
                    @csrf

                    <div class="form-group mt-3">
                        <label for="alamat">Alamat</label>
                        @if(!empty($alamat[0]))
                        <select class="form-control select2 my-2" name="alamat" id="alamat">
                            <option disabled value>Pilih alamat</option>
                            @foreach($alamat as $item)
                            <option value="{{ $item->id }}"> {{ $item->alamat }}</option>
                            @endforeach
                        </select>
                        @else
                        <div class="mt-3">
                            <div class="montserrat-extra text-danger font-smaller">Belum ada alamat yang terdaftar, silahkan Tambah Alamat</div>
                            <a href="{{ url('/profile/alamat/addView') }}" class="btn btn-primary me-5 mt-2" id="pesan-btn-sedang">
                                <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Alamat
                            </a>
                            @endif
                        </div>
                    </div>

                    @if(!empty($alamat[0]))
                    <div class="montserrat-extra text-start color-inti">
                        <span class="">Jarak ke Klinik (meter) : </span>
                        <input type="text" name="jarak" id="jarak" style="border: none; font-weight: bolder;" value="{{ $alamat[0]->jarak }}" readonly>
                    </div>
                    @endif

                    <div class="form-group mt-4">
                        <label for="keluhan">Keluhan Penyakit <span class="color-abu-tuo">(jika ada)</span></label>
                        <input type="text" name="keluhan" id="keluhan" placeholder="Contoh: Perih dibagian luka" class="form-control my-2" value="{{ old('keluhan') }}">
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_perawatan">Tanggal Perawatan </label>
                                <input name="tanggal_perawatan" id="tanggal_perawatan" placeholder="Silahkan pilih Tanggal Perawatan " class="form-control my-2" value="{{ old('tanggal_perawatan') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jam_perawatan">Jam Perawatan <span class="font-smaller color-abu-tuo">(08.00-18.30)</span></label>
                                <input name="jam_perawatan" id="jam_perawatan" placeholder="Silahkan pilih Jam Perawatan" class="form-control my-2" value="{{ old('jam_perawatan') }}" required>
                            </div>
                        </div>
                    </div>

                    @if($layanan->use_foto == 'Y')
                    <div class="form-group mt-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control my-2" accept="image/*">
                    </div>
                    @endif

                    <div class="form-group mt-4">
                        <label for="id_status_jasa">Jasa Tenaga Medis</label>
                        <select class="form-control select2 my-2" name="id_status_jasa" id="id_status_jasa">
                            <option disabled value>Pilih jasa</option>
                            @foreach($jasa as $item)
                            @if($item->status_user->status !== "Pasien" && $item->status_user->status !== "Admin" && $item->status_user->is_active !== "T")
                            <option value="{{ $item->id_status_jasa }}|{{ $item->status_user->status }}|{{ $item->harga }}"> {{ $item->status_user->status }} -- Rp @currency($item->harga)</option>
                            @endif

                            @endforeach
                        </select>
                    </div>

                    <input hidden type="text" id="harga_status_jasa" class="form-control my-2" value="Rp @currency($item->harga)">

                    <button type="button" class="btn btn-success mt-3" id="pesan-btn" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiPesananPasien">Pesan</button>
                </form>

                <!-- Modal Konfirmasi Pesanan Pasien -->
                <div class="modal fade" id="modalKonfirmasiPesananPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-tipis">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="fa-regular fa-file-lines nav_icon" style="color: #3E82E4; font-size: 70px;"></i>
                                </div>
                                <div class="text-center montserrat-extra mt-4" style="font-size: larger;">Konfirmasi Pesanan</div>
                                <table class="table table-borderless mt-4">
                                    <tbody>
                                        <tr class="montserrat-extra font-smaller">
                                            <td class="text-start">Layanan</td>
                                            <td class="color-abu text-end">{{ $layanan->nama_layanan }}</td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Tanggal</td>
                                            <td class="color-abu text-end" id="tanggalModal"></td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Jam</td>
                                            <td class="color-abu text-end" id="jamModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="montserrat-extra font-smaller">
                                            <td class="text-start">Tenaga Medis</td>
                                            <td class="color-abu text-end" id="tenagaMedisModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Harga</td>
                                            <td class="color-abu text-end" id="hargaModal"></td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Ongkos</td>
                                            <td class="color-abu text-end" id="ongkosModal"></td>
                                        </tr>
                                        <tr class="montserrat-extra">
                                            <td class="text-start">Total</td>
                                            <td class="color-abu text-end" id="totalModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-6 text-center">
                                    <!-- Buttton Cancel -->
                                    <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-6 text-center">
                                    <!-- Button Konfirmasi Pesanan -->
                                    <button type="submit" form="formTambahPesanan" class="btn btn-primary" id="btn-konfirmasi-sedang">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

</x-inti-layout>
<link rel="stylesheet" href="{{ asset('css/floatingWA.css') }}">

<script src="{{ asset('js/map.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhFi_DeV49ieQ_kgMtM8-YOP03wDimivM&callback=initMap&libraries=places&v=weekly" defer></script>
<script>
    $(document).ready(function() {
        $('#alamat').on('change', function() {
            var jarakID = $(this).val();
            $.ajax({
                url: '/getJarak/' + jarakID,
                method: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response.jarak[0].jarak);
                    $('#jarak').val(response.jarak[0].jarak);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    $("#tanggal_perawatan").flatpickr({
        dateFormat: "Y-m-d",
        minDate: "today",
        "disable": [
            function(date) {
                return (date.getDay() === 0); // disable hari minggu
            }
        ],
        locale: "id"
    });

    let currentDate = new Date();
    let currentHours = currentDate.getHours();
    let currentMinutes = currentDate.getMinutes() + 1; // Masih ada kemungkinan dio mesen di menit yg pas
    $("#jam_perawatan").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: "08:00",
        maxTime: "18:30",
        locale: "id",
        "disable": [
            function(date) {
                return (date.getHours() <= 8); // Disable sebelum jam 8
            }
        ]
    });
</script>
<script>
    const formatRupiah = (money) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(money);
    }
    $(function() {
        $("#pesan-btn").on("click", function() {
            let tanggalPerawatan = $("#tanggal_perawatan").val();
            let jamPerawatan = $("#jam_perawatan").val() == "" ? "Belum Diisi" : $("#jam_perawatan").val();
            var data = $("#id_status_jasa").val().split('|');
            let tenagaMedis = data[1];
            let hargaTenagaMedis = parseInt(data[2]);
            let jarak = $("#jarak").val();
            let jarak2 = Math.round(jarak / 1000);
            let ongkos = 0;
            // if(jarak2<=5){
            //     let ongkos = 0;
            // }else if(jarak2<=10){
            //     let ongkos = 15000;
            // }else{
            //     let ongkos = (jarak2-10)*3000;
            // }
            let total = parseInt(ongkos + hargaTenagaMedis);
            $("#tanggalModal").text(formatTanggal(tanggalPerawatan));
            $("#jamModal").text(jamPerawatan);
            $("#tenagaMedisModal").text(tenagaMedis);
            $("#hargaModal").text(formatRupiah(hargaTenagaMedis));
            $("#ongkosModal").text(formatRupiah(ongkos));
            $("#totalModal").text(formatRupiah(total));
        });
    });
</script>
<script>
    const formatTanggal = tanggalInput => {
        let tanggal = tanggalInput.substr(8, 2);
        let bulan = tanggalInput.substr(5, 2);
        let tahun = tanggalInput.substr(0, 4);

        let namaBulan = "";
        switch (bulan) {

            case "01":
                namaBulan = "Januari";
                break;

            case "02":
                namaBulan = "Februari";
                break;

            case "03":
                namaBulan = "Maret";
                break;

            case "04":
                namaBulan = "April";
                break;

            case "05":
                namaBulan = "Mei";
                break;

            case "06":
                namaBulan = "Juni";
                break;

            case "07":
                namaBulan = "Juli";
                break;

            case "08":
                namaBulan = "Agustus";
                break;

            case "09":
                namaBulan = "September";
                break;

            case "10":
                namaBulan = "Oktober";
                break;

            case "11":
                namaBulan = "November";
                break;

            case "12":
                namaBulan = "Desember";
                break;

            default:
                namaBulan = "Belum Diisi";

        }
        return `${tanggal} ${namaBulan} ${tahun}`;
    }
</script>