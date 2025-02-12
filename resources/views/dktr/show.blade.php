@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Detail Dokter</h2>
            <a class="btn btn-secondary" href="{{ route('dktr.index') }}">Kembali</a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th class="fw-bold">ID Dokter:</th>
                        <td>{{ $dktr->idDokter }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Nama Dokter:</th>
                        <td>{{ $dktr->namaDokter }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Lahir:</th>
                        <td>{{ $dktr->tanggalLahir }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Spesialisasi:</th>
                        <td>{{ $dktr->spesialisasi }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Lokasi Praktik:</th>
                        <td>{{ $dktr->lokasiPraktik }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Jam Praktik:</th>
                        <td>{{ $dktr->jamPraktik }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
