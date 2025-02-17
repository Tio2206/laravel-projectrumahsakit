@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Detail Ruangan</h2>
            <a class="btn btn-secondary" href="{{ route('ruangan.index') }}">Kembali</a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th class="fw-bold">Kode Ruangan:</th>
                        <td>{{ $ruangan->kodeRuangan }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Nama Ruangan:</th>
                        <td>{{ $ruangan->namaRuangan }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Daya Tampung:</th>
                        <td>{{ $ruangan->dayaTampung }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Lokasi:</th>
                        <td>{{ $ruangan->lokasi }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
