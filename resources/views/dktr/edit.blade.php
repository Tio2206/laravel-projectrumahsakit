@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit Data Dokter</h2>
            <a class="btn btn-secondary" href="{{ route('dktr.index') }}">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terdapat beberapa kesalahan dalam input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('dktr.update', $dktr->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">ID Dokter</label>
                        <input type="text" name="idDokter" class="form-control" placeholder="Masukkan ID Dokter"
                            value="{{ $dktr->idDokter }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Dokter</label>
                        <input type="text" name="namaDokter" class="form-control" placeholder="Masukkan Nama Dokter"
                            value="{{ $dktr->namaDokter }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" name="tanggalLahir" class="form-control" value="{{ $dktr->tanggalLahir }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Spesialisasi</label>
                        <select name="spesialisasi" class="form-select">
                            <option value="{{ $dktr->spesialisasi }}" selected>{{ $dktr->spesialisasi }}</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Anak">Poli Anak</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Mata">Poli Mata</option>
                            <option value="Poli Kulit">Poli Kulit</option>
                            <option value="Poli Penyakit Dalam">Poli Penyakit Dalam</option>
                            <option value="Poli Konseling">Poli Konseling</option>
                            <option value="Poli Saraf">Poli Saraf</option>
                            <option value="Poli THT">Poli THT</option>
                            <option value="Poli Bedah">Poli Bedah</option>
                            <option value="Poli Paru">Poli Paru</option>
                            <option value="Poli Jantung">Poli Jantung</option>
                            <option value="Poli Gizi Klinik">Poli Gizi Klinik</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Lokasi Praktik</label>
                        <select name="lokasiPraktik" class="form-select">
                            @foreach($ruangans as $ruangan)
                                <option value="{{ $ruangan->namaRuangan }}"
                                    {{ $ruangan->namaRuangan == $dktr->lokasiPraktik ? 'selected' : '' }}>
                                    {{ $ruangan->namaRuangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jam Praktik</label>
                        <input type="time" name="jamPraktik" class="form-control" value="{{ $dktr->jamPraktik }}">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
