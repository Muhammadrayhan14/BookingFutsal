@extends('layouts.frontend.main')

@section('konten')
<!-- HERO SECTION -->
<section class="hero-section bg-dark text-white position-relative overflow-hidden">
  <div class="container">
    <div class="row align-items-center min-vh-80">
      <div class="col-lg-6 py-5" data-aos="fade-right">
        <h1 class="display-4 fw-bold mb-3 text-light">Booking Lapangan Futsal Online</h1>
        <p class="lead mb-4">Nikmati kemudahan booking lapangan futsal kapan saja, di mana saja. Fasilitas terbaik dengan harga terjangkau.</p>
        <div class="d-flex gap-3">
          <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Booking Sekarang</a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-lg">
          <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
               alt="Lapangan Futsal" class="img-fluid object-fit-cover">
        </div>
      </div>
    </div>
  </div>
  
  <!-- Shape divider -->

</section>

<!-- ABOUT SECTION -->
<section id="tentang" class="py-5 bg-light">
  <div class="container py-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow">
          <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
               alt="Tentang Kami" class="img-fluid object-fit-cover">
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <span class="badge bg-primary mb-2">Tentang Kami</span>
        <h2 class="mb-4">Futsal Center Terbaik di Kota Anda</h2>
        <p class="lead mb-4">Kami menyediakan lapangan futsal berkualitas tinggi dengan sistem booking online yang mudah dan cepat.</p>
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-white p-3 rounded-3 shadow-sm h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-calendar-check text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Booking Online</h5>
                <p class="mb-0 text-muted small">Booking kapan saja melalui website atau aplikasi</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-white p-3 rounded-3 shadow-sm h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-star text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Lapangan Premium</h5>
                <p class="mb-0 text-muted small">Lapangan berkualitas dengan rumput sintetis terbaik</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FACILITIES SECTION -->
<section id="fasilitas" class="py-5 bg-white">
  <div class="container py-5">
    <div class="text-center mb-5">
      <span class="badge bg-primary mb-2">Fasilitas</span>
      <h2 class="mb-3">Fasilitas Unggulan Kami</h2>
      <p class="text-muted mx-auto" style="max-width: 600px;">Kami menyediakan berbagai fasilitas pendukung untuk kenyamanan bermain futsal Anda</p>
    </div>
    
    <div class="row g-4">
      <div class="col-md-6 col-lg-3" data-aos="zoom-in">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-img-top overflow-hidden">
            <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
                 alt="Lapangan Futsal" class="img-fluid object-fit-cover" style="height: 180px; width: 100%;">
          </div>
          <div class="card-body">
            <h5 class="card-title">Lapangan Standar FIFA</h5>
            <p class="card-text text-muted small">Lapangan berstandar internasional dengan rumput sintetis terbaik</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-img-top overflow-hidden">
            <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
                 alt="Pencahayaan" class="img-fluid object-fit-cover" style="height: 180px; width: 100%;">
          </div>
          <div class="card-body">
            <h5 class="card-title">Pencahayaan LED</h5>
            <p class="card-text text-muted small">Pencahayaan full LED untuk kenyamanan bermain malam hari</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-img-top overflow-hidden">
            <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
                 alt="Loker" class="img-fluid object-fit-cover" style="height: 180px; width: 100%;">
          </div>
          <div class="card-body">
            <h5 class="card-title">Loker & Kamar Mandi</h5>
            <p class="card-text text-muted small">Fasilitas loker dan kamar mandi yang bersih dan nyaman</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-img-top overflow-hidden">
            <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
                 alt="Kantin" class="img-fluid object-fit-cover" style="height: 180px; width: 100%;">
          </div>
          <div class="card-body">
            <h5 class="card-title">Kantin & Rest Area</h5>
            <p class="card-text text-muted small">Area istirahat dengan kantin yang menyediakan makanan sehat</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PRICING SECTION -->




<!-- TESTIMONIAL SECTION -->
<section class="py-5 bg-light" id="testimoni">
  <div class="container py-5">
    <div class="text-center mb-5">
      <span class="badge bg-primary mb-2">Testimonial</span>
      <h2 class="mb-3">Apa Kata Pelanggan Kami</h2>
      <p class="text-muted mx-auto" style="max-width: 600px;">Berikut beberapa testimoni dari pelanggan yang sudah menggunakan layanan kami</p>
    </div>
    
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex mb-3">
              <div class="flex-shrink-0">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="rounded-circle" width="50">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">Aldo Wijaya</h5>
                <div class="text-warning small">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
            </div>
            <p class="card-text">"Lapangannya sangat nyaman dengan rumput sintetis berkualitas. Proses booking online juga sangat mudah dan cepat."</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex mb-3">
              <div class="flex-shrink-0">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="rounded-circle" width="50">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">Rina</h5>
                <div class="text-warning small">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
              </div>
            </div>
            <p class="card-text">"Fasilitas lengkap dan bersih. Pencahayaan di malam hari sangat bagus, tidak silau dan merata di seluruh lapangan."</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex mb-3">
              <div class="flex-shrink-0">
                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="rounded-circle" width="50">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">Lutfi Hadit</h5>
                <div class="text-warning small">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </div>
              </div>
            </div>
            <p class="card-text">"Sering booking untuk latihan tim kami. Pelayanannya bagus dan harganya terjangkau untuk kualitas lapangan seperti ini."</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT SECTION -->
<section id="kontak" class="py-5 bg-white">
  <div class="container py-5">
    <div class="row g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <span class="badge bg-primary mb-2">Kontak</span>
        <h2 class="mb-4">Hubungi Kami</h2>
        <p class="lead mb-4">Butuh bantuan atau informasi lebih lanjut? Silakan hubungi kami melalui kontak berikut.</p>
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-light p-3 rounded-3 h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-map-marker-alt text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Alamat</h5>
                <p class="mb-0 text-muted small">Jl. Futsal No. 123, Kota Anda</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-light p-3 rounded-3 h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-phone-alt text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Telepon</h5>
                <p class="mb-0 text-muted small">(021) 1234-5678</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-light p-3 rounded-3 h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-envelope text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Email</h5>
                <p class="mb-0 text-muted small">info@futsalcenter.com</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-start bg-light p-3 rounded-3 h-100">
              <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fas fa-clock text-light fs-4"></i>
              </div>
              <div>
                <h5 class="mb-1">Jam Operasional</h5>
                <p class="mb-0 text-muted small">08:00 - 22:00 (Setiap Hari)</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-lg">
          <img src="{{ asset('frontend/img/lapangan.jpg') }}" 
               alt="Lapangan Futsal" class="img-fluid object-fit-cover">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CUSTOM STYLE -->
<style>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1600&q=80') no-repeat center center;
    background-size: cover;
    position: relative;
  }
  
  /* General */
  .min-vh-80 {
    min-height: 80vh;
  }
  
  .object-fit-cover {
    object-fit: cover;
  }
  
  /* Card Hover Effect */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  
  /* Pricing Card */
  .pricing-card-title {
    font-size: 2.5rem;
  }
  
  /* Testimonial Stars */
  .text-warning {
    color: #ffc107 !important;
  }
  
  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .hero-section {
      text-align: center;
    }
    
    .hero-section .btn {
      display: block;
      width: 100%;
      margin-bottom: 1rem;
    }
    
    .hero-section .d-flex {
      flex-direction: column;
    }
  }
</style>

@endsection