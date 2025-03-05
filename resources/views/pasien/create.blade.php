@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Tambah Pasien Baru</h2>
            <a class="btn btn-secondary" href="{{ route('pasien.index') }}">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Input Gagal.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('pasien.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Rekam Medis</label>
                        <input type="text" name="nomorRekamMedis" class="form-control" placeholder="Masukkan Nomor Rekam Medis">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pasien</label>
                        <input type="text" name="namaPasien" class="form-control" placeholder="Masukkan Nama Pasien">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pasien</label>
                        <textarea name="alamatPasien" class="form-control" placeholder="Masukkan Alamat Pasien" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kota Pasien</label>
                        <input type="text" name="kotaPasien" class="form-control" placeholder="Masukkan Kota Pasien">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" value="L" id="lakiLaki">
                            <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" value="P" id="perempuan">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Masuk</label>
                        <input type="date" name="tanggalMasuk" class="form-control">
                    </div>

                    <div class="mb-3" style="display: none;">
                        <label class="form-label fw-bold">Usia Pasien</label>
                        <input type="hidden" name="usiaPasien" class="form-control" id="usiaPasien">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Dokter</label>
                        <div class="d-flex gap-2">
                            <select name="dokter" class="form-select select2" id="dokter">
                                <option value="">- Pilih Dokter -</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}" data-spesialisasi="{{ $dokter->spesialisasi }}">
                                        {{ $dokter->namaDokter }} - {{ $dokter->spesialisasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="penyakitPasien" id="penyakitPasien">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Kamar</label>
                        <select name="nomorKamar" class="form-select" id="nomorKamar">
                            <option value="">- Pilih Kamar -</option>
                            @foreach($kamar as $r)
                                <option value="{{ $r->id }}" data-dayatampung="{{ $r->dayaTampung }}">
                                    {{ $r->namaRuangan }} (Daya Tampung: {{ $r->dayaTampung }})
                                </option>
                            @endforeach
                        </select>
                        <div id="alertKamar" class="alert alert-danger mt-2" style="display: none;">Kamar penuh! Silakan pilih kamar lain.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Load jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // Event listener untuk perubahan dokter
            $(document).on('change', '#dokter', function() {
                let selectedOption = $(this).find(':selected');
                let spesialisasi = selectedOption.data('spesialisasi') || '';
                $('#penyakitPasien').val(spesialisasi);
            });

            // Event listener untuk menghitung usia pasien
            $('#tanggalLahir').on('change', function() {
                let birthDate = new Date(this.value);
                if (!this.value || isNaN(birthDate)) {
                    $('#usiaPasien').val('');
                    return;
                }
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#usiaPasien').val(age);
            });

            // Event listener untuk perubahan nomor kamar
            $('#nomorKamar').on('change', function() {
                let selectedOption = $(this).find(':selected');
                let dayaTampung = selectedOption.data('dayatampung');
                if (dayaTampung == 0) {
                    $('#alertKamar').show();
                } else {
                    $('#alertKamar').hide();
                }
            });
        });
    </script>
@endsection
