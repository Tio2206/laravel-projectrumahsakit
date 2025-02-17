@extends('template')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Medicare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (Auth::user()->role !== 'User')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ruangan.index') }}">Ruangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dktr.index') }}">Dokter</a>
                            </li>
                        @endif
                        <!-- Profile Icon -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'default-profile.png')) }}"
                                    alt="Profile Picture" class="rounded-circle"
                                    style="width: 35px; height: 35px; object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.view') }}">View & Edit Profile</a></li>
                                <li>
                                    <form action="{{ route('actionlogout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to Our Website</h1>
            <p class="lead">Your health is our priority. Find the best doctors and services here.</p>
            @auth
                <a href="#dokter" class="btn btn-primary btn-lg shadow-sm">Find a Doctor</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow-sm">Login to Get Started</a>
            @endauth
        </div>
    </section>

    @auth
        <!-- Dokter Section (Hanya Tampil Jika Sudah Login dan Bukan User) -->
        <section id="dokter" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Our Doctors</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Dr. John Doe</h3>
                                <p class="card-text">Cardiologist</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Dr. Jane Smith</h3>
                                <p class="card-text">Pediatrician</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Dr. Emily Brown</h3>
                                <p class="card-text">Dermatologist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-2">&copy; 2025 Medicare. All rights reserved.</p>
            <div>
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </footer>
@endsection
