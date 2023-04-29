<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">

<x-inti-layout :title="'Buat Pesanan'">

    <div class="container">
        <div class="pt-5">
            <div class="pt-5 pb-4">
                <div class="mt-5">
                    <a href="{{ url('/layanan/'.$layanan->id) }}" class="me-3 d-inline"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3 class="d-inline montserrat-extra text-start">{{ $layanan->nama_layanan }}</h3>

                    {{-- @if (session()->has('info'))
                    <div class="alert alert-success">
                        {{ session()->get('info') }}
                    </div>
                    @endif --}}

                </div>

                <div class="mt-4">
                    @if($errors->any())
                    {!! implode('', $errors->all('
                    <div class="text-danger ms-3 mt-2 montserrat-extra"><i class="fa-2xs fa-sharp fa-solid fa-circle"></i> &nbsp; :message </div>
                    ')) !!}
                    @endif
                </div>

                <!-- <div class="mt-4">
                        <input id="origin-input" class="form-control" type="text" placeholder="Enter an origin location" />

                        <input id="destination-input" class="controls" type="text" placeholder="Enter a destination location" />

                        <div id="mode-selector" class="controls">
                            <input type="radio" name="type" id="changemode-walking" checked="checked" />
                            <label for="changemode-walking">Walking</label>

                            <input type="radio" name="type" id="changemode-transit" />
                            <label for="changemode-transit">Transit</label>

                            <input type="radio" name="type" id="changemode-driving" />
                            <label for="changemode-driving">Driving</label>
                        </div>
                    </div> -->

                <!-- <div id="jarak">Jarak rumah pasien ke klinik : </div>
                    <div id="hasil"></div>

                    <div id="map" style="height: 50%; display: none;"></div> -->

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
                        <a href="{{ url('/profile/alamat/addView') }}" class="btn btn-primary me-5 mt-4" id="pesan-btn-sedang">
                            <i class="fa-solid fa-plus fa-lg me-3"></i>Tambah Alamat
                        </a>
                        @endif
                    </div>

                    @if(!empty($alamat[0]))
                    <div>
                        <span class="montserrat-bold text-start">Jarak ke Klinik (meter) : </span>
                        <input type="text" name="jarak" id="jarak" style="border: none;" value="{{$alamat[0]->jarak}}" readonly>
                    </div>
                    @endif

                    <div class="form-group mt-3">
                        <label for="keluhan">Keluhan penyakit</label>
                        <input type="text" name="keluhan" id="keluhan" placeholder="Masukkan keluhan anda" class="form-control my-2" value="{{ old('keluhan') }}">
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_perawatan">Jadwal </label>
                                <input name="tanggal_perawatan" id="tanggal_perawatan" placeholder="Masukkan tanggal perawatan" class="form-control my-2" value="{{ old('tanggal_perawatan') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jam_perawatan">Jam Perawatan </label>
                                <input name="jam_perawatan" id="jam_perawatan" placeholder="Masukkan jam perawatan" class="form-control my-2" value="{{ old('jam_perawatan') }}" required>
                            </div>
                        </div>
                    </div>

                    @if($layanan->use_foto == 'Y')
                    <div class="form-group mt-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control my-2" accept="image/*">
                    </div>
                    @endif

                    <div class="form-group mt-3">
                        <label for="id_status_jasa">Jasa</label>
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
                                <div class="text-center montserrat-bold mt-4 color-abu">Apakah anda ingin mengkonfirmasi pesanan ini?
                                    <br>Pastikan semua data sudah terisi dengan benar.
                                </div>
                                <table class="table table-borderless mt-4">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Layanan</td>
                                            <td class="montserrat-extra color-abu text-end">{{ $layanan->nama_layanan }}</td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Tanggal</td>
                                            <td class="montserrat-extra color-abu text-end" id="tanggalModal"></td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td>Jam</td>
                                            <td class="montserrat-extra color-abu text-end" id="jamModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Tenaga Medis</td>
                                            <td class="montserrat-extra color-abu text-end" id="tenagaMedisModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Harga</td>
                                            <td class="montserrat-extra color-abu text-end" id="hargaModal"></td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Ongkos</td>
                                            <td class="montserrat-extra color-abu text-end" id="ongkosModal"></td>
                                        </tr>
                                        <tr class="montserrat-bold font-smaller">
                                            <td class="text-start">Total</td>
                                            <td class="montserrat-extra color-abu text-end" id="totalModal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-md-6 text-center">
                                    <!-- Buttton Cancel -->
                                    <button type="button" class="btn btn-secondary" id="btn-cancel-sedang" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-md-6 text-center">
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
<script src="{{ asset('js/map.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhFi_DeV49ieQ_kgMtM8-YOP03wDimivM&callback=initMap&libraries=places&v=weekly" defer></script>
<script>
    function validateInput(event) {
    const key = event.key;
    const regex = /^[a-zA-Z]+$/;

    if (!regex.test(key)) {
      event.preventDefault();
    }
  }

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

    $("#jam_perawatan").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: "08:00",
        maxTime: "18:30",
        locale: "id"
    });
</script>
<script>
    $(function() {
        $("#pesan-btn").on("click", function() {
            let tanggalPerawatan = $("#tanggal_perawatan").val();
            let jamPerawatan = $("#jam_perawatan").val();
            var data = $("#id_status_jasa").val().split('|');
            let tenagaMedis = data[1];
            let hargaTenagaMedis = parseInt(data[2]);
            let jarak = $("#jarak").val();
            let ongkos = Math.round(jarak/1000) *1000;
            let total = parseInt(ongkos+hargaTenagaMedis);
            $("#tanggalModal").text(tanggalPerawatan);
            $("#jamModal").text(jamPerawatan);
            $("#tenagaMedisModal").text(tenagaMedis);
            $("#hargaModal").text("Rp "+hargaTenagaMedis);
            $("#ongkosModal").text("Rp "+ongkos);
            $("#totalModal").text("Rp "+total);
        });
    });
</script>