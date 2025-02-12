@extends('template')

@section('content')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h2 class="text-center fw-bold">Registrasi Aplikasi</h2>
                    <h5 class="text-center text-muted">Dashboard</h5>
                    <hr>

                    <!-- Display Error Message -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <b>Oops!</b> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('actionregister') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label"><i class="fas fa-phone"></i> No Telepon</label>
                            <input type="text" name="telp" class="form-control" placeholder="No Telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i>
                            Register</button>
                    </form>
                    <hr>
                    <p class="text-center mb-1">Sudah punya akun? <a href="{{ route('login.index') }}"
                            class="text-primary">Login</a> sekarang!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
