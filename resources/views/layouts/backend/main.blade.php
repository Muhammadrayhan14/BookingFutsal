<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Anak Rawa Futsal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('layouts.backend.css')
</head>




<body>
    <div class="container-xxl position-relative bg-white d-flex p-0 min-vh-100">
        {{-- sidebar --}}
        @include('layouts.backend.sidebar')

        <div class="content d-flex flex-column w-100">
            {{-- navbar --}}
            @include('layouts.backend.navbar')
            
            <!-- Content Start -->
            <main class="flex-grow-1 p-4">
                @yield('konten')
                
            </main>
            <!-- Content End -->
            
            <!-- Footer Start -->
            <footer class="mt-auto">
                @include('layouts.backend.footer')
            </footer>
            <!-- Footer End -->
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-dark btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>

    @include('layouts.backend.js')

     <!-- Scripts -->
     @stack('scripts')
     @yield('scripts')
</body>

</html>