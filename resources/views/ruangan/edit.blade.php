@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit Data Ruangan</h2>
            <a class="btn btn-secondary" href="{{ route('ruangan.index') }}">Kembali</a>
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
                <form action="{{ route('ruangan.update', $ruangan->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Ruangan</label>
                        <input type="text" name="kodeRuangan" class="form-control" placeholder="Masukkan Kode Ruangan"
                            value="{{ $ruangan->kodeRuangan }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Ruangan</label>
                        <input type="text" name="namaRuangan" class="form-control" placeholder="Masukkan Nama Ruangan"
                            value="{{ $ruangan->namaRuangan }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Daya Tampung</label>
                        <input type="number" name="dayaTampung" class="form-control" placeholder="Masukkan Daya Tampung"
                            value="{{ $ruangan->dayaTampung }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Masukkan Lokasi"
                            value="{{ $ruangan->lokasi }}">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
