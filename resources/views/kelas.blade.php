@extends('layouts.frontend.main')

@section('title', 'Daftar Kelas - Max Power Gym')

@section('konten')
<div class="class-listing-page bg-white">

  <!-- Hero Section -->
  <section class="class-hero text-dark py-5">
    <div class="container py-4">
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
          <h1 class="display-5 fw-bold mb-3">Kelas Fitness Kami</h1>
          <p class="lead mb-4">Temukan kelas yang sesuai dengan tujuan fitness Anda. Dari pemula hingga profesional, kami memiliki program untuk semua level.</p>
          <div class="d-flex gap-3">
            <a href="#class-list" class="btn custom-primary btn-lg px-4">Lihat Kelas</a>
            <a href="{{ route('register') }}" class="btn custom-outline-primary btn-lg px-4">Daftar Sekarang</a>
            
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
          <img src="{{ asset('frontend/img/class-hero.png') }}" class="img-fluid rounded-3" alt="Class Hero">
        </div>
      </div>
    </div>
  </section>

  <!-- Class List -->
  <section id="class-list" class="py-5">
    <div class="container">
      <div class="section-header mb-5 text-center">
        <h2 class="fw-bold">Pilih Kelas Anda</h2>
        <p class="text-muted">Tersedia berbagai kelas dengan instruktur profesional</p>
      </div>

      @if($kelas->isEmpty())
      <div class="empty-state text-center py-5">
        <img src="{{ asset('frontend/img/empty-class.png') }}" class="img-fluid mb-4" style="max-width: 300px;" alt="No Classes">
        <h4 class="mb-3">Belum ada kelas tersedia</h4>
        <p class="text-muted mb-4">Kami sedang mempersiapkan kelas terbaik untuk Anda. Silakan cek kembali nanti.</p>
        <a href="{{ route('index') }}" class="btn btn-primary px-4">Kembali ke Beranda</a>
      </div>
      @else
      <div class="row g-4">
        @foreach ($kelas as $kls)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="class-card card h-100 border-0 shadow-sm overflow-hidden">
            <div class="class-thumbnail position-relative">
              @if ($kls->gambar)
              <img src="{{ asset('storage/' . $kls->gambar) }}" class="w-100" alt="{{ $kls->nama_kelas }}">
              @endif
            </div>

            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h3 class="h5 card-title mb-0">{{ $kls->nama_kelas }}</h3>
                <span class="badge bg-primary text-white">{{ $kls->level ?? 'Semua Level' }}</span>
              </div>

              <div class="class-instructor mb-3">
                <div class="d-flex align-items-center">
                  <div class="instructor-avatar me-2">
                    @if($kls->instruktur && $kls->instruktur->foto)
                    <img src="{{ asset('storage/' . $kls->instruktur->foto) }}" class="rounded-circle" width="40" height="40" alt="{{ $kls->instruktur->nama }}">
                    @else
                    <div class="avatar-placeholder rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                      <i class="fas fa-user text-white"></i>
                    </div>
                    @endif
                  </div>
                  <div>
                    <p class="mb-0 small text-muted">Instruktur</p>
                    <p class="mb-0 fw-bold">{{ $kls->instruktur->nama ?? 'TBA' }}</p>
                  </div>
                </div>
              </div>

              <p class="card-text text-muted mb-4">{{ $kls->deskripsi ?? 'Kelas ini dirancang untuk meningkatkan kebugaran dan kesehatan Anda.' }}</p>

              <div class="class-schedule mb-4">
                <div class="row g-2">
                  <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                      <p class="mb-0 small text-muted">Hari</p>
                      <p class="mb-0 fw-bold">{{ ucfirst($kls->hari) ?? '-' }}</p>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                      <p class="mb-0 small text-muted">Jam</p>
                      <p class="mb-0 fw-bold">{{ $kls->jam ? date('H:i', strtotime($kls->jam)) : '-' }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="class-meta d-flex justify-content-between align-items-center">
                <div>
                  <p class="mb-0 small text-muted">Kapasitas</p>
                  <p class="mb-0">{{ $kls->kapasitas ?? '20' }} Peserta</p>
                </div>
                <div>
                  <p class="mb-0 small text-muted">Durasi</p>
                  <p class="mb-0">{{ $kls->durasi ?? '60' }} Menit</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section py-5 bg-primary text-white" data-aos="fade-up">
    <div class="container text-center py-4 rounded-pill" style="background-color: #ffffff">
        <h2 class="fw-bold mb-3">Siap Memulai Perjalanan Fitness Anda?</h2>
        <p class="lead mb-4 text-dark">Daftar sekarang dan ayo mulai bentuk badan impian kamu!!</p>
        <a href="{{ route('register') }}" class="btn btn-light text-dark btn-lg px-4">Daftar Sekarang</a>
      </div>
      
      
  </section>

</div>

<style>
  .class-hero {
    background: #f8f9fa;
  }

  .class-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
  }

  .class-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .class-thumbnail img {
    height: 200px;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .class-card:hover .class-thumbnail img {
    transform: scale(1.05);
  }

  .cta-section {
    background: linear-gradient(135deg, #1e88e5 0%, #0d47a1 100%);
  }

  .empty-state {
    background-color: #f8f9fa;
    border-radius: 12px;
  }
  .custom-primary {
    background-color: #1e88e5; /* Biru cerah */
    border: none;
    color: #fff;
  }
  .custom-primary:hover {
    background-color: #1565c0; /* Biru tua */
  }

  .custom-outline-primary {
    background: transparent;
    border: 2px solid #1e88e5;
    color: #1e88e5;
  }
  .custom-outline-primary:hover {
    background: #1e88e5;
    color: #fff;
  }

  .cta-section .btn-light {
    background: #fff;
    color: #1e88e5;
    border: none;
  }

  .cta-section .btn-light:hover {
    background: #f8f9fa;
    color: #1565c0;
  }
</style>

<!-- AOS Animation -->

<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
@endsection
