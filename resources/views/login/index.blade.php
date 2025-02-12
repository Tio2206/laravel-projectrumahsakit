@extends('template')

@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <h2 class="text-center fw-bold">Login Aplikasi</h2>
                <h5 class="text-center text-muted">Dashboard</h5>
                <hr>

                <!-- Display Success Message -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <b>Oops!</b> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Log In</button>
                </form>

                <hr>
                <p class="text-center mb-1">Belum punya akun? <a href="{{ route('register.index') }}" class="text-primary">Register</a> sekarang!</p>
                <p class="text-center"><a href="{{ route('forgotPassword') }}" class="text-danger">Lupa Password?</a></p>
                <p class="text-center"><a href="{{ url('/') }}" class="text-primary">Home</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
