@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">CRUD DOKTER</h2>
                <div>
                    <a class="btn btn-success me-2" href="{{ route('dktr.create') }}">Input Dokter</a>
                    <a class="btn btn-primary" href="/">Home</a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <!-- Search form -->
                <form action="{{ route('dktr.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}" placeholder="Search by Nama Dokter">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <!-- Clear Button -->
                        <a href="{{ route('dktr.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">{{ $message }}</div>
        @endif

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th width="50px">#</th>
                        <th>ID Dokter</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal Lahir</th>
                        <th>Spesialisasi</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dktr as $dokter)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $dokter->idDokter }}</td>
                            <td>{{ $dokter->namaDokter }}</td>
                            <td>{{ $dokter->tanggalLahir }}</td>
                            <td>{{ $dokter->spesialisasi }}</td>
                            <td>
                                <form action="{{ route('dktr.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-info btn-sm" href="{{ route('dktr.show', $dokter->id) }}">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('dktr.edit', $dokter->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol Delete dengan Modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dokter->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $dokter->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data dokter <strong>{{ $dokter->namaDokter }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {!! $dktr->links() !!}
        </div>
    </div>
@endsection
