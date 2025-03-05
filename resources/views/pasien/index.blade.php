@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Daftar Pasien</h2>
                <a class="btn btn-success" href="{{ route('pasien.create') }}">Tambah Pasien</a>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nomor Rekam Medis</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Penyakit</th>
                    <th>Dokter</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Nomor Kamar</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pasiens as $index => $pasien)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->NomorRekamMedis }}</td>
                        <td>{{ $pasien->namaPasien }}</td>
                        <td>{{ $pasien->tanggalLahir }}</td>
                        <td>{{ $pasien->jenisKelamin }}</td>
                        <td>{{ $pasien->usiaPasien }}</td>
                        <td>{{ $pasien->penyakitPasien }}</td>
                        <td>{{ $pasien->dokter->namaDokter ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $pasien->tanggalMasuk }}</td>
                        <td>{{ $pasien->tanggalKeluar ?? '-' }}</td>
                        <td>{{ $pasien->nomorKamar }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('pasiens.show', $pasien->id) }}">
                                <i class="fas fa-eye"></i> Show
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('pasiens.edit', $pasien->id) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('pasiens.destroy', $pasien->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {!! $pasiens->links() !!}
        </div>
    </div>
@endsection
