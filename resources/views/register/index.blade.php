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
                    <form action="{{ route('actionregister') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> <b>Oops!</b> There were some problems with your
                                input.
                                <ul class="mt-2 mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telp" class="form-label"><i class="fas fa-phone"></i> No Telepon</label>
                            <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror"
                                placeholder="No Telepon" value="{{ old('telp') }}" required>
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Alamat" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label"><i class="fas fa-image"></i> Profile
                                Picture</label>
                            <input type="file" name="profile_picture"
                                class="form-control @error('profile_picture') is-invalid @enderror">
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i>
                            Register</button>
                    </form>
                    <hr>
                    <p class="text-center mb-1">Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-primary">Login</a> sekarang!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
