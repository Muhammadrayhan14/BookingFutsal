<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Anak Rawa Futsal') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600,700" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background-color: #0A0F0F; border-bottom: 2px solid #FF7B25;">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-futbol me-2" style="color: #FF7B25;"></i>
                    <span>Anak</span><span style="color: #FF7B25;">Rawa</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ms-2">
                                    <a class="nav-link btn btn-primary text-white px-3" href="{{ route('register') }}" style="background-color: #FF7B25; border-color: #FF7B25;">
                                        <i class="fas fa-user-plus me-1"></i>{{ __('Daftar') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="me-2 d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 32px; height: 32px; background-color: #FF7B25;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #1E2329; border: 1px solid #2D343E;">
                                    <a class="dropdown-item text-white" href="#" style="background-color: #1E2329;">
                                        <i class="fas fa-user me-2" style="color: #FF7B25;"></i> Profile
                                    </a>
                                    <a class="dropdown-item text-white" href="#" style="background-color: #1E2329;">
                                        <i class="fas fa-cog me-2" style="color: #FF7B25;"></i> Settings
                                    </a>
                                    <div class="dropdown-divider" style="border-color: #2D343E;"></div>
                                    <a class="dropdown-item text-white" href="{{ route('logout') }}" style="background-color: #1E2329;"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2" style="color: #FF7B25;"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: calc(100vh - 120px);">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 text-white" style="background-color: #0A0F0F; border-top: 2px solid #FF7B25;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <span>&copy; {{ date('Y') }} Anak Rawa Futsal. All rights reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>
    :root {
        --primary-color: #FF7B25;
        --primary-hover: #E56A1B;
        --dark-color: #0A0F0F;
        --light-color: #f8fafc;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }
    
    .navbar {
        padding: 1rem 0;
    }
    
    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    
    .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8) !important;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        position: relative;
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    
    .nav-link:hover, .nav-link:focus {
        color: var(--primary-color) !important;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--primary-color);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
        width: 100%;
    }
    
    .dropdown-menu {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        border-radius: 0.5rem;
        padding: 0.5rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover, .dropdown-item:focus {
        background-color: rgba(255, 123, 37, 0.1) !important;
        color: var(--primary-color) !important;
    }
    
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }
    
    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 123, 37, 0.25);
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 123, 37, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    footer a {
        transition: all 0.3s ease;
    }
    
    footer a:hover {
        color: var(--primary-color) !important;
        transform: translateY(-2px);
    }
    
    @media (max-width: 767.98px) {
        .navbar-nav {
            padding-top: 1rem;
        }
        
        .nav-item {
            margin: 0.25rem 0;
        }
        
        .nav-link {
            padding: 0.75rem 0;
        }
    }
</style>
</html>