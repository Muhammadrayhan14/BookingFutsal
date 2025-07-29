@extends('layouts.frontend.main')

@section('title', 'Pilih Paket Membership')

@section('konten')
<div class="package-selection-page bg-white">

  <!-- Hero Section -->
  <section class="package-hero text-dark py-5">
    <div class="container py-4">
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
          <h1 class="display-5 fw-bold mb-3">Pilih Paket Membership</h1>
          <p class="lead mb-4">Temukan paket yang sempurna untuk perjalanan fitness Anda. Mulai dari pemula hingga atlet profesional.</p>
          <div class="d-flex gap-3">
            <a href="#package-list" class="btn custom-primary btn-lg px-4">Lihat Paket</a>
            <a href="{{ route('kelas') }}" class="btn custom-outline-primary btn-lg px-4">Lihat Kelas</a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
            <div style="overflow: hidden; border-radius: 1rem;">
                <img src="{{ asset('frontend/img/package-hero.png') }}" class="img-fluid" alt="Package Hero">
              </div>
              
        </div>
      </div>
    </div>
  </section>

  <!-- Package List -->
  <section id="package-list" class="py-5">
    <div class="container">
      <div class="section-header mb-5 text-center">
        <h2 class="fw-bold">Pilihan Paket Membership</h2>
        <p class="text-muted">Tentukan pilihan terbaik sesuai kebutuhan latihan Anda</p>
        @php
        $promoAktif = \App\Models\Promo::where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
    @endphp
        @if ($promoAktif)
        <div class="container">
            <div class="promo-banner">
                <div class="promo-badge">PROMO</div>
                <div class="promo-content">
                    <h3 class="text-light">{{ $promoAktif->nama_promo }}</h3>
                    <p class="text-dark">Diskon {{ $promoAktif->persentase_diskon }}% untuk waktu terbatas!</p>
                </div>
                <div class="promo-countdown">
                    <div class="countdown-item">
                        <span id="countdown-days" class="text-light">00</span>
                        <small class="text-light">Hari</small>
                    </div>
                    <div class="countdown-item">
                        <span id="countdown-hours" class="text-light">00</span>
                        <small class="text-light">Jam</small>
                    </div>
                    <div class="countdown-item">
                        <span id="countdown-minutes" class="text-light">00</span>
                        <small class="text-light">Menit</small>
                    </div>
                </div>
            </div>
        </div>
        @endif
      </div>

      <div class="row justify-content-center g-4">
        @foreach ($pakets->sortBy('durasi_hari') as $paket)

        @php
        $promo = $promoAktif;
        $diskon = 0;
        $hargaDiskon = $paket->harga;

        if ($promo) {
            $diskon = ($paket->harga * $promo->persentase_diskon) / 100;
            $hargaDiskon = $paket->harga - $diskon;
        }
    @endphp
        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="package-card card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-header  text-white text-center py-3" style="background-color: #01ffff">
              <h3 class="mb-0 fw-bold">PAKET {{ strtoupper($paket->nama_paket) }}</h3>
            </div>
            
            <div class="card-body text-center py-4">

              @if ($promoAktif)
              <div class="featured-badge">
                Diskon : <strong>{{ $promoAktif->persentase_diskon  }} %</strong>
              </div>
            @endif
            
            <div class="package-price mb-4">
              @if ($promoAktif)
                <h5 class="text-muted mb-1" style="text-decoration: line-through;">
                  Rp{{ number_format($paket->harga, 0, ',', '.') }}
                </h5>
                <h2 class="text-dark fw-bold">
                  Rp{{ number_format($hargaDiskon, 0, ',', '.') }}
                </h2>
                <small class="text-danger d-block mb-2">Hemat {{ $promoAktif->persentase_diskon }}%</small>
              @else
                <h2 class="text-dark fw-bold">
                  Rp{{ number_format($paket->harga, 0, ',', '.') }}
                </h2>
              @endif
              <p class="text-muted mb-0">Untuk {{ $paket->durasi_hari }} Hari</p>
              <div class="divider my-3 mx-auto bg-dark"></div>
            </div>
            
            
              
              <ul class="package-features list-unstyled mb-4">
                @foreach(explode("\n", $paket->deskripsi) as $feature)
                <li class="mb-2 d-flex align-items-start">
          
                  <span>{{ trim($feature) }}</span>
                </li>
                @endforeach
              </ul>
              
              <div class="package-meta bg-light p-3 rounded mb-4">
                <div class="row g-2">
                  <div class="col-6">
                    <div class="p-2 rounded">
                      <p class="mb-0 small text-muted">Akses Gym</p>
                      <p class="mb-0 fw-bold">Unlimited</p>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="p-2 rounded">
                      <p class="mb-0 small text-muted">Kelas Gratis</p>
                      <p class="mb-0 fw-bold">Ya</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card-footer bg-white border-0 pt-0 pb-4">
              <a href="{{ route('register') }}" class="btn custom-primary w-100 py-2">
                Daftar
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Comparison Section -->
  <section class="package-comparison py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Perbandingan Paket</h2>
        <p class="text-muted">Lihat perbedaan antara paket yang tersedia</p>
      </div>
      
      <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="text-dark" style="background-color: #01ffff">
              <tr>
                <th>Fitur</th>
                <th class="text-center">1 Bulan</th>
                <th class="text-center">3 Bulan</th>
                <th class="text-center">1 Tahun</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Akses 24/7</td>
                <td class="text-center">✔</td>
                <td class="text-center">✔</td>
                <td class="text-center">✔</td>
              </tr>
              <tr>
                <td>Kelas Gratis</td>
                <td class="text-center">✖</td>
                <td class="text-center">✔</td>
                <td class="text-center">✔</td>
              </tr>
              <tr>
                <td>Konsultasi Trainer</td>
                <td class="text-center">✔</td>
                <td class="text-center">✔</td>
                <td class="text-center">✔</td>
              </tr>
              <tr>
                <td>Free Locker</td>
                <td class="text-center">✖</td>
                <td class="text-center">✖</td>
                <td class="text-center">✔</td>
              </tr>
              <tr>
                <td>Free Towel</td>
                <td class="text-center">✖</td>
                <td class="text-center">✖</td>
                <td class="text-center">✔</td>
              </tr>
            </tbody>
          </table>
          
      </div>
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
.featured-badge {
    position: absolute;
    top: 15px;
    right: -39px;
    background: #f70d20;
    color: white;
    padding: 0.25rem 2rem;
    font-size: 0.7rem;
    font-weight: 600;
    transform: rotate(45deg);
    box-shadow: 0 4px 10px rgba(241, 44, 44, 0.3);
}

.promo-banner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: linear-gradient(135deg, #f70d20, #ff6b6b);
  color: #fff;
  border-radius: 1rem;
  padding: 1.5rem 2rem;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  margin: 2rem 0;
}

.promo-badge {
  background: #000;
  color: #fff;
  font-size: 0.9rem;
  padding: 0.4rem 1rem;
  border-radius: 20px;
  font-weight: bold;
  position: absolute;
  top: 1px;
  left: 20px;
  z-index: 2;
}

.promo-content {
  z-index: 2;
}

.promo-content h3 {
  margin: 0;
  font-weight: 700;
}

.promo-content p {
  margin: 0;
  font-weight: 500;
}

.promo-countdown {
  display: flex;
  gap: 1rem;
  z-index: 2;
}

.countdown-item {
  background: rgba(255, 255, 255, 0.2);
  padding: 0.5rem 1rem;
  border-radius: 8px;
  text-align: center;
  min-width: 60px;
}

.countdown-item span {
  display: block;
  font-size: 1.5rem;
  font-weight: 700;
  color: #fff;
}

.countdown-item small {
  font-size: 0.75rem;
  color: #fff;
  text-transform: uppercase;
}

@media (max-width: 768px) {
  .promo-banner {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }

  .promo-badge {
    position: static;
    margin-bottom: 1rem;
  }
}
  .promo-badge {
  display: inline-block;
  background: #f94144; /* merah promo */
  color: #fff;
  padding: 0.3rem 0.75rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 500;
}
  .package-hero {
    background: #f8f9fa;
  }

  .package-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
  }

  .package-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }

  .package-price h2 {
    font-size: 2.2rem;
  }

  .divider {
    width: 50px;
    height: 3px;
  }

  .cta-section {
    background: linear-gradient(135deg, #ffffff 0%, #02c1ce 100%);
  }

  .custom-primary {
    background-color: #2600ff;
    color: #fff;
    border: none;
  }

  .custom-primary:hover {
    background-color: #1565c0;
    color: #fff;
  }

  .custom-outline-primary {
    border: 2px solid #1e88e5;
    color: #1e88e5;
    background: transparent;
  }

  .custom-outline-primary:hover {
    background: #1e88e5;
    color: #fff;
  }

  .table th {
    font-weight: 600;
  }

  @media (max-width: 767.98px) {
    .package-price h2 {
      font-size: 1.8rem;
    }
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if ($promoAktif)
      const promoEnd = new Date("{{ $promoAktif->tanggal_selesai->format('Y-m-d H:i:s') }}").getTime();

      const countdown = setInterval(function() {
        const now = new Date().getTime();
        const distance = promoEnd - now;

        if (distance < 0) {
          clearInterval(countdown);
          document.querySelector(".promo-banner").style.display = "none";
          return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        document.getElementById("countdown-days").textContent = String(days).padStart(2, '0');
        document.getElementById("countdown-hours").textContent = String(hours).padStart(2, '0');
        document.getElementById("countdown-minutes").textContent = String(minutes).padStart(2, '0');
      }, 1000);
    @endif
  });
</script>

