@extends('layouts.frontend.main')

@section('title', 'Our Coaches - Max Power Gym')

@section('konten')
<div class="coach-page">

    <!-- HERO SECTION -->
    <section class="hero-coach"  data-aos="fade-up">
      <div class="hero-overlay"></div>
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-lg-6">
            <h1 class="hero-title text-light">Ubah Badan Kamu Jadi Badan Impian <span>Dengan Trainer Profesional</span></h1>
            <p class="hero-subtitle">Certified coaches to bring out the champion in you with personalized training.</p>
             <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-3">Sign Up Now</a>
            <a href="#" class="btn btn-outline-light btn-lg px-5">Learn More</a>
          </div>
          </div>
          <div class="col-lg-6 d-none d-lg-block">
            <div class="hero-image-wrapper">
              <img src="{{ asset('frontend/img/coach-hero-redesign.png') }}" alt="Fitness Coaches" class="hero-image">
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- COACH GRID -->
    <section id="coach-list" class="py-5 mt-5"  data-aos="zoom-in">
      <div class="container bg-light rounded-6 p-5 shadow">
        <div class="section-header text-center mb-4">
          <h2 class="section-title">Meet Your <span>Dream Team</span></h2>
          <p class="section-subtitle">Our coaches are your partners in transformation</p>
          <div class="divider mx-auto"></div>
        </div>
  
        @if($instrukturs->isEmpty())
        <div class="empty-state text-center py-5">
          <div class="empty-icon mb-4">
            <i class="fas fa-dumbbell"></i>
          </div>
          <h4 class="mb-3">Coaches Coming Soon</h4>
          <p class="text-muted mb-4">We're assembling an elite team of trainers to serve you better</p>
          @auth
          <a href="{{ route('instruktur.create') }}" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Add First Coach
          </a>
          @endauth
        </div>
        @else
        <div class="row g-4 justify-content-center">
          @foreach ($instrukturs as $instruktur)
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="coach-card rounded-4 overflow-hidden">
              <div class="coach-image">
                @if($instruktur->foto)
                  <img src="{{ asset('storage/' . $instruktur->foto) }}" alt="{{ $instruktur->nama }}" class="img-fluid w-100 h-100">
                @else
                  <img src="{{ asset('frontend/img/coach-default-redesign.jpg') }}" alt="Default Coach" class="img-fluid w-100 h-100">
                @endif
                <div class="coach-specialty">{{ $instruktur->spesialisasi }}</div>
              </div>
              <div class="coach-body">
                <h3 class="coach-name">{{ $instruktur->nama }}</h3>
                <div class="coach-contact">
                  <i class="fas fa-phone-alt"></i>
                  <span>{{ $instruktur->no_hp ?? 'Contact Gym' }}</span>
                </div>
                <p class="coach-bio">{{ $instruktur->deskripsi ?? 'Passionate about helping clients achieve their goals.' }}</p>
                
                @auth
                <div class="coach-actions">
                  <a href="{{ route('instruktur.edit', $instruktur->id) }}" class="btn btn-sm btn-edit">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('instruktur.destroy', $instruktur->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete this coach?')" class="btn btn-sm btn-delete">
                      <i class="fas fa-trash-alt"></i> Delete
                    </button>
                  </form>
                </div>
                @endauth
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </section>
  
    <!-- TESTIMONIALS -->
    <section class="testimonials py-6 bg-light mt-5"  data-aos="zoom-in">
      <div class="container">
        <div class="section-header text-center mb-5">
          <h2 class="section-title">Success <span>Stories</span></h2>
          <p class="section-subtitle">What our members say about our coaches</p>
          <div class="divider mx-auto"></div>
        </div>
        
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="testimonial-card">
              <div class="testimonial-rating">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <p class="testimonial-text">"Coach Sarah transformed my approach to fitness. Lost 20kg in 6 months!"</p>
              <div class="testimonial-author">
                <strong>Michael T.</strong><span>Member since 2021</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="testimonial-card">
              <div class="testimonial-rating">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <p class="testimonial-text">"Coach David helped me train for my first marathon. Couldn't have done it without him!"</p>
              <div class="testimonial-author">
                <strong>Jennifer L.</strong><span>Member since 2022</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="testimonial-card">
              <div class="testimonial-rating">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
              </div>
              <p class="testimonial-text">"Coach Alex helped me build consistent habits. Life-changing!"</p>
              <div class="testimonial-author">
                <strong>Robert K.</strong><span>Member since 2020</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- CTA SECTION -->
    <section class="cta-section py-6"  data-aos="fade-up">
      <div class="container">
        <div class="cta-box text-center text-white p-5 rounded-4">
          <h2 class="cta-title mb-4">Ready to Begin Your Transformation?</h2>
          <p class="cta-text mb-5">Join Max Power Gym today and get matched with your perfect coach</p>
          <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-3">Sign Up Now</a>
            <a href="#" class="btn btn-outline-light btn-lg px-5">Learn More</a>
          </div>
        </div>
      </div>
    </section>
  
  </div>

<style>
  /* HERO SECTION */

  
  .hero-coach {
    background: linear-gradient(135deg, #1a2a6c 0%, #4a03ff 50%, #cac9c6 100%);
    color: white;
    padding: 8rem 0;
    position: relative;
    overflow: hidden;
  }
  
  .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
  }
  #coach-list { margin-top: 5rem; }
  .coach-card { rounded, overflow, shadow }
  .container { p-5 }
  
  .hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    position: relative;
  }
  
  .hero-title span {
    color: #2d34fd;
  }
  
  .hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
  }
  
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
  
  .hero-badge {
    position: absolute;
    bottom: -20px;
    right: -20px;
    background: #00fdec;
    color: #1a2a6c;
    border-radius: 15px;
    padding: 15px 20px;
    font-weight: 700;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  }
  
  .badge-number {
    font-size: 2rem;
    display: block;
    line-height: 1;
  }
  
  .badge-text {
    font-size: 0.9rem;
    display: block;
  }
  
  /* SECTION HEADERS */
  .section-header {
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }
  
  .section-title span {
    color: #0059ff;
  }
  
  .section-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
  }
  
  .divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, #1a2a6c, #00ddff);
    margin-top: 1.5rem;
    border-radius: 2px;
  }
  
  /* COACH CARDS */
  .coach-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .coach-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  }
  
  .coach-image {
    position: relative;
    overflow: hidden;
    height: 280px;
  }
  
  .coach-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .coach-card:hover .coach-image img {
    transform: scale(1.05);
  }
  
  .coach-specialty {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: rgba(26, 42, 108, 0.9);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
  }
  
  .coach-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  
  .coach-name {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #1a2a6c;
  }
  
  .coach-contact {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    color: #6c757d;
  }
  
  .coach-contact i {
    margin-right: 8px;
    color: #08eff7;
  }
  
  .coach-bio {
    color: #6c757d;
    margin-bottom: 1.5rem;
    flex: 1;
  }
  
  .coach-actions {
    display: flex;
    gap: 10px;
  }
  
  .btn-edit, .btn-delete {
    flex: 1;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
  }
  
  .btn-edit {
    background: #1a2a6c;
    color: white;
    border: none;
  }
  
  .btn-delete {
    background: #1900fc;
    color: white;
    border: none;
  }
  
  /* TESTIMONIALS */
  .testimonial-card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
  }
  
  .testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }
  
  .testimonial-rating {
    color: #00f2ff;
    margin-bottom: 1.5rem;
  }
  
  .testimonial-text {
    font-style: italic;
    margin-bottom: 2rem;
    color: #495057;
    position: relative;
  }
  
  .testimonial-text:before {
    content: '"';
    font-size: 3rem;
    color: rgba(26, 42, 108, 0.1);
    position: absolute;
    top: -20px;
    left: -10px;
  }
  
  .testimonial-author {
    border-top: 1px solid #eee;
    padding-top: 1rem;
  }
  
  .testimonial-author strong {
    display: block;
    color: #032dd6;
  }
  
  .testimonial-author span {
    font-size: 0.8rem;
    color: #6c757d;
  }
  
  /* CTA SECTION */
  .cta-section {
    background: linear-gradient(135deg, #00b7ff 0%, #00fffb 100%);
  }
  
  .cta-box {
    background: url('{{ asset('frontend/img/cta-pattern.png') }}') center/cover;
    position: relative;
    overflow: hidden;
  }
  
  .cta-box:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 42, 108, 0.9);
  }
  
  .cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
  }
  
  .cta-text {
    font-size: 1.2rem;
    opacity: 0.9;
    position: relative;
  }
  
  .cta-buttons {
    position: relative;
  }
  
  /* EMPTY STATE */
  .empty-state {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 3rem;
  }
  
  .empty-icon {
    font-size: 3rem;
    color: #0400ff;
  }
  
  /* RESPONSIVE ADJUSTMENTS */
  @media (max-width: 992px) {
    .hero-title {
      font-size: 2.8rem;
    }
    
    .hero-image-wrapper {
      margin-top: 3rem;
    }
  }
  
  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.2rem;
    }
    
    .section-title {
      font-size: 2rem;
    }
    
    .cta-title {
      font-size: 2rem;
    }
  }

  <script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
</style>
@endsection