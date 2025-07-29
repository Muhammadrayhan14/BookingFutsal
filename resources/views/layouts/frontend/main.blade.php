<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Anak Rawa Futsal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('layouts.frontend.css')
    
    <style>
        body {
            background-color: #2c2a2a !important;
        }
    </style>
    
   
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->
    
     {{-- navbar --}}
     @include('layouts.frontend.navbar')

     {{-- konten --}}
     @yield('konten')

     {{-- footer --}}
     @include('layouts.frontend.footer')

     {{-- javascript --}}
     @include('layouts.frontend.js')


  


   

    
</body>

</html>