@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">CRUD RUANGAN</h2>
                <div>
                    <a class="btn btn-success me-2" href="{{ route('ruangan.create') }}">Input Ruangan</a>
                    <a class="btn btn-primary" href="/">Home</a>
                </div>
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
                        <th>Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th>Daya Tampung</th>
                        <th>Lokasi</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangan as $room)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $room->kodeRuangan }}</td>
                            <td>{{ $room->namaRuangan }}</td>
                            <td>{{ $room->dayaTampung }}</td>
                            <td>{{ $room->lokasi }}</td>
                            <td>
                                <form action="{{ route('ruangan.destroy', $room->id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-info btn-sm" href="{{ route('ruangan.show', $room->id) }}">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('ruangan.edit', $room->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol Delete dengan Modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $room->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $room->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ruangan
                                                    <strong>{{ $room->namaRuangan }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
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
            {!! $ruangan->links() !!}
        </div>
    </div>
@endsection
