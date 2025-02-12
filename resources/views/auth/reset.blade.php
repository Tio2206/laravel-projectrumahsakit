@extends('template')

@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <h2 class="text-center fw-bold">Reset Password</h2>
                <hr>

                <!-- Display Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="old_password" class="form-label"><i class="fas fa-lock"></i> Old Password</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Enter old password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sync-alt"></i> Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
