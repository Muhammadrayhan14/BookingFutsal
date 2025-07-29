@extends('layouts.frontend.main')

@section('title', 'Fasilitas - Max Power Gym')

@section('konten')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Fasilitas <span class="text-primary">Premium</span> Kami</h1>
                <p class="lead mb-4">Temukan lingkungan latihan ideal dengan peralatan terbaik dan fasilitas modern yang dirancang untuk membantu Anda mencapai tujuan kebugaran.</p>
                <a href="#" class="btn btn-primary btn-lg rounded-pill px-4">Jadwalkan Tur</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                 <div class="hero-image-wrapper">
                   <img src="{{ asset('frontend/img/coach-hero-redesign.png') }}" alt="Fitness Coaches" class="hero-image">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Facilities Section -->
<div class="py-5 my-5">
    <div class="container">
        <h2 class="text-center section-title">Fasilitas Unggulan Kami</h2>
        
        <div class="row">
            <!-- Facility 1 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1538805060514-97d9cc17730c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                         alt="Cardio Area" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3>Area Cardio</h3>
                        <p>Peralatan cardio terbaru dengan teknologi canggih termasuk treadmill, elliptical, dan sepeda statis.</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility 2 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                         alt="Weight Training" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <h3>Angkat Beban</h3>
                        <p>Area angkat beban lengkap dengan peralatan premium dari brand ternama dunia.</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility 3 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1545389336-cf090694435e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80" 
                         alt="Yoga Studio" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-spa"></i>
                        </div>
                        <h3>Studio Yoga</h3>
                        <p>Studio khusus yoga dengan lantai springboard dan suasana yang menenangkan.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Facility 4 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1562771379-eafdca7a02f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Swimming Pool" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-swimming-pool"></i>
                        </div>
                        <h3>Kolam Renang</h3>
                        <p>Kolam renang semi-olimpik dengan sistem penyaringan air mutakhir.</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility 5 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Locker Room" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3>Ruang Ganti Premium</h3>
                        <p>Ruang ganti pribadi dengan fasilitas lengkap termasuk sauna dan steam room.</p>
                    </div>
                </div>
            </div>
            
            <!-- Facility 6 -->
            <div class="col-md-4">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1555244162-803834f70033?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Cafe" class="facility-img">
                    <div class="p-4">
                        <div class="icon-box">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Health Cafe</h3>
                        <p>Kafe sehat menyajikan makanan dan minuman bernutrisi tinggi pasca latihan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Peralatan</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Jam Operasional</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">3000m²</div>
                    <div class="stat-label">Area Gym</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Kelas per Minggu</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="py-5 my-5">
    <div class="container">
        <h2 class="text-center section-title">Apa Kata Member Kami</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Member" class="testimonial-img">
                    <h4>Sarah Wijaya</h4>
                    <p class="text-muted">Member sejak 2020</p>
                    <p>"Fasilitas di MAXPOWER sangat lengkap dan terawat baik. Saya selalu nyaman berlatih di sini."</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Member" class="testimonial-img">
                    <h4>Budi Santoso</h4>
                    <p class="text-muted">Member sejak 2021</p>
                    <p>"Peralatan strength training-nya sangat lengkap dan selalu dalam kondisi prima. Recommended!"</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Member" class="testimonial-img">
                    <h4>Dewi Lestari</h4>
                    <p class="text-muted">Member sejak 2022</p>
                    <p>"Studio yoganya sangat nyaman dengan pencahayaan alami. Instrukturnya juga profesional."</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section">
    <div class="container">
        <h2 class="mb-4">Siap Memulai Perjalanan Kebugaran Anda?</h2>
        <p class="lead mb-5">Daftar sekarang dan dapatkan tur fasilitas gratis serta konsultasi dengan trainer kami.</p>
        <a href="#" class="btn btn-primary btn-lg rounded-pill px-5 py-3">Daftar Sekarang</a>
    </div>
</div>

<style>
    /* Navbar styles from your previous code */
   
    
    /* New Facilities Page Styles */
    .hero-image-wrapper {
    position: relative;
    max-width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    transform: perspective(1000px) rotateY(-15deg);
    transition: transform 0.5s ease;
  }
  
  .hero-image-wrapper:hover {
    transform: perspective(1000px) rotateY(-5deg);
  }
  
  .hero-image {
    width: 100%;
    height: auto;
    display: block;
  }
    .hero-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 5rem 0;
    }
    .section-title {
        position: relative;
        margin-bottom: 3rem;
    }
    .section-title::after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background: #4e73df;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }
    .facility-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    .facility-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .facility-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }
    .icon-box {
        width: 60px;
        height: 60px;
        background: #4e73df;
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .stats-section {
        background: linear-gradient(135deg, #4e73df 0%, #3b5ab5 100%);
        color: white;
        padding: 4rem 0;
    }
    .stat-item {
        text-align: center;
        padding: 0 1.5rem;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .testimonial-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin: 1rem;
    }
    .testimonial-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }
    .cta-section {
        background: #f8f9fa;
        padding: 5rem 0;
        text-align: center;
    }
</style>
@endsection