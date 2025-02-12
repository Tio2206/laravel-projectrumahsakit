@extends('template')

@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <h2 class="text-center fw-bold">Lupa Password</h2>
                <hr>

                <!-- Display Success Message -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {!! session('status') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('sendResetLink') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i> Kirim Link Reset</button>
                </form>
                <hr>
                <p class="text-center mt-2"><a href="{{ route('login.index') }}" class="text-primary">Kembali ke Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
