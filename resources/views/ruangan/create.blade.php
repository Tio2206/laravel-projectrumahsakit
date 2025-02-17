@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Tambah Ruangan Baru</h2>
            <a class="btn btn-secondary" href="{{ route('ruangan.index') }}">Kembali</a>
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
                <form action="{{ route('ruangan.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Ruangan</label>
                        <input type="text" name="kodeRuangan" class="form-control" placeholder="Masukkan Kode Ruangan">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Ruangan</label>
                        <input type="text" name="namaRuangan" class="form-control" placeholder="Masukkan Nama Ruangan">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Daya Tampung</label>
                        <input type="number" name="dayaTampung" class="form-control" placeholder="Masukkan Daya Tampung Ruangan">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Lokasi</label>
                        <select name="lokasi" class="form-select">
                            <option value="">- Pilih Lokasi -</option>
                            <option value="Lantai 1">Lantai 1</option>
                            <option value="Lantai 2">Lantai 2</option>
                            <option value="Lantai 3">Lantai 3</option>
                            <option value="Gedung A">Gedung A</option>
                            <option value="Gedung B">Gedung B</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
