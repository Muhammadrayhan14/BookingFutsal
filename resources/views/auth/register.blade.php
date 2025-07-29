@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-3 overflow-hidden" style="background-color: rgba(10, 15, 15, 0.9); border-top: 4px solid #FF7B25;">
                    <!-- Card Header with Futsal Theme -->
                    <div class="card-header py-4" style="background: linear-gradient(135deg, #FF7B25 0%, #E56A1B 100%);">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-futbol fa-2x me-3 text-white"></i>
                            <h2 class="h4 text-center mb-0 fw-bold text-white">{{ __('Daftar Akun Baru') }}</h2>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label text-white">{{ __('Nama Lengkap') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #1E2329; border-color: #2D343E;">
                                        <i class="fas fa-user text-primary"></i>
                                    </span>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                           placeholder="Masukkan nama lengkap"
                                           style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nomor HP Field -->
                            <div class="mb-4">
                                <label for="nohp" class="form-label text-white">{{ __('Nomor HP') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #1E2329; border-color: #2D343E;">
                                        <i class="fas fa-phone text-primary"></i>
                                    </span>
                                    <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" 
                                           name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp"
                                           placeholder="Masukkan nomor HP"
                                           style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                    @error('nohp')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-white">{{ __('Alamat Email') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #1E2329; border-color: #2D343E;">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="Masukkan alamat email"
                                           style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-white">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #1E2329; border-color: #2D343E;">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password"
                                           placeholder="Buat password"
                                           style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Minimal 8 karakter</small>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-5">
                                <label for="password-confirm" class="form-label text-white">{{ __('Konfirmasi Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #1E2329; border-color: #2D343E;">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control" 
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Konfirmasi password"
                                           style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" style="background-color: #1E2329; border-color: #2D343E; color: white;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold" style="background: linear-gradient(135deg, #FF7B25 0%, #E56A1B 100%); border: none;">
                                    <i class="fas fa-user-plus me-2"></i>{{ __('Daftar Sekarang') }}
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="mb-0 text-white">Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-primary fw-bold" style="color: #FF7B25 !important;">{{ __('Login Disini') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .form-control {
        padding: 12px 15px;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 123, 37, 0.25);
        border-color: #FF7B25;
    }
    
    .input-group-text {
        border-right: none;
    }
    
    .toggle-password {
        border-left: none;
        transition: all 0.3s ease;
    }
    
    .toggle-password:hover {
        color: #FF7B25 !important;
    }
    
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 123, 37, 0.4);
    }
    
    .invalid-feedback {
        color: #FF7B25;
    }
    
    @media (max-width: 767.98px) {
        .card-body {
            padding: 2rem;
        }
    }
</style>

<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endsection