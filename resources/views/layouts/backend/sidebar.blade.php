<!-- Premium Futsal Dashboard Sidebar - White & Orange Theme -->
<div class="sidebar d-flex flex-column flex-shrink-0" style="width: 250px; min-height: 100vh; background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%); border-right: 1px solid rgba(255, 102, 0, 0.1);">
  <!-- Sidebar Header with Futsal Branding -->
  <div class="sidebar-header p-4 d-flex flex-column align-items-center" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255, 102, 0, 0.1);">
    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none mb-3">
      <div class="sidebar-logo-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.967) 0%, rgba(255, 102, 0, 0.05) 100%); box-shadow: 0 4px 15px rgba(255, 102, 0, 0.1);">
        <i class="fas fa-futbol" style="color: #000000; font-size: 1.5rem;"></i>
      </div>
      <div>
        <h2 class="sidebar-logo-text text-dark mb-0 fw-bold fs-4" style="letter-spacing: 1.5px;">ANAK<span style="color: #ff6600; text-shadow: 0 0 10px rgba(255, 102, 0, 0.2);">RAWA</span></h2>
        <small class="text-muted d-block" style="font-size: 0.65rem; letter-spacing: 1px;">FUTSAL</small>
      </div>
    </a>
  </div>

  <!-- User Profile Section -->
  <div class="sidebar-user-profile p-4 d-flex align-items-center position-relative" style="background: rgba(255, 255, 255, 0.9); margin: 12px; border-radius: 12px; backdrop-filter: blur(4px); border: 1px solid rgba(0, 0, 0, 0.05); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
    <div class="sidebar-avatar-container position-relative me-3">
      <img class="sidebar-user-avatar rounded-circle shadow" src="{{ asset('template') }}/img/user.jpg" alt="User" style="width: 25px; height:40px; object-fit: cover; border: 2px solid rgba(255, 102, 0, 0.5);">
      <span class="sidebar-user-status position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
    </div>
    <div class="sidebar-user-info flex-grow-1">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="sidebar-user-name mb-0 text-dark fw-semibold fs-6">{{ strtok(Auth::user()->name, ' ') }}</h6>
        <span class="sidebar-user-role badge fs-7 px-2 py-1" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%); color: #ff6600; border: 1px solid rgba(255, 102, 0, 0.2);">
          @if(Auth::user()->role == 'admin')
            <i class="fas fa-shield-alt me-1"></i> Admin
          @elseif(Auth::user()->role == 'pelanggan')
            <i class="fas fa-user-tie me-1"></i> Pelanggan
          @elseif(Auth::user()->role == 'pengelola')
          <i class="fas fa-user-tie me-1"></i> Pengelola
          @else
            <i class="fas fa-user-graduate me-1"></i> -
          @endif
        </span>
      </div>
  
      @if(Auth::user()->role == 'pelanggan')
      
      @endif
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="quick-actions p-3 mx-3 mb-3" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; border: 1px solid rgba(0, 0, 0, 0.05);">
    <h6 class="text-muted mb-3 fw-semibold fs-7 text-uppercase" style="letter-spacing: 1px;">Menu</h6>
    
  </div>

  <!-- Navigation Menu -->
  <div class="sidebar-menu flex-grow-1 overflow-y-auto px-3">
    <ul class="nav flex-column sidebar-nav-list">
      @if(Auth::check())
        @switch(Auth::user()->role)


          @case('admin')
            <!-- Admin Menu -->
            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-tachometer-alt" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Dashboard</span>
                <span class="badge bg-primary ms-auto fs-7" style="background: rgba(255, 102, 0, 0.1) !important; color: #ff6600;">3</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>

            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('users.index') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-tachometer-alt" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Data User</span>
                <span class="badge bg-primary ms-auto fs-7" style="background: rgba(255, 102, 0, 0.1) !important; color: #ff6600;">3</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>

            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('lapangan.index') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-tachometer-alt" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Lapangan</span>
                <span class="badge bg-primary ms-auto fs-7" style="background: rgba(255, 102, 0, 0.1) !important; color: #ff6600;">3</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>

            
          

            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('admin.pembayaran.riwayat') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-calendar-check" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Riwayat Transaksi</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>
            
            <li class="sidebar-nav-item mb-2 dropdown">
              <a href="#" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                      <i class="fas fa-file-alt" style="color: #ff6600;"></i>
                  </div>
                  <span class="sidebar-nav-text fs-6">Laporan</span>
                  <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
              <ul class="dropdown-menu shadow-lg border-0 rounded-3 p-2" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(6px); min-width: 220px;">
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.user') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Laporan User
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.lapangan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Laporan Lapangan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan pertanggal
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan.perbulan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan perbulan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan.pertahun') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan pertahun
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran pertanggal
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran.perbulan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran perbulan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran.pertahun') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran pertahun
                  </a>
                </li>




              </ul>
            </li>
            @break

          @case('pelanggan')
            <!-- Member Menu -->
            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('member.dashboard') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-tachometer-alt" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Jadwal Booking</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>
            
        

            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('pembayaran.riwayat') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-futbol" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Riwayat Transaksi</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>

           
           
            @break


            @case('pengelola')
            <!-- Member Menu -->
            <li class="sidebar-nav-item mb-2">
              <a href="{{ route('pengelola.dashboard') }}" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative">
                <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                  <i class="fas fa-tachometer-alt" style="color: #ff6600;"></i>
                </div>
                <span class="sidebar-nav-text fs-6">Dashboard</span>
                <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
            </li>
            
        

            <li class="sidebar-nav-item mb-2 dropdown">
              <a href="#" class="sidebar-nav-link text-muted px-3 py-3 d-flex align-items-center position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="sidebar-nav-icon me-3 p-2 rounded-3" style="background: linear-gradient(135deg, rgba(255, 102, 0, 0.1) 0%, rgba(255, 102, 0, 0.05) 100%);">
                      <i class="fas fa-file-alt" style="color: #ff6600;"></i>
                  </div>
                  <span class="sidebar-nav-text fs-6">Laporan</span>
                  <div class="nav-highlight" style="background: linear-gradient(90deg, #ff6600, #ff9933);"></div>
              </a>
              <ul class="dropdown-menu shadow-lg border-0 rounded-3 p-2" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(6px); min-width: 220px;">
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.user') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Laporan User
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.lapangan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Laporan Lapangan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan pertanggal
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan.perbulan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan perbulan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pemesanan.pertahun') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pemesanan pertahun
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran pertanggal
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran.perbulan') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran perbulan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-muted px-3 py-2 rounded-2 mb-1" href="{{ route('laporan.pembayaran.pertahun') }}">
                    <i class="fas fa-exchange-alt me-2" style="color: #ff4d00;"></i>
                    Pembayaran pertahun
                  </a>
                </li>




              </ul>
            </li>

           
           
            @break
        @endswitch
      @endif
    </ul>
    
    <!-- Divider -->
    <div class="mx-3 my-4" style="border-top: 1px solid rgba(0, 0, 0, 0.05);"></div>
    
   
  </div>

  <!-- Logout & Settings -->
  <div class="sidebar-footer p-3" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); border-top: 1px solid rgba(255, 102, 0, 0.1);">
    <div class="d-flex justify-content-between mb-3">
      <button class="btn btn-sm px-3 py-2 d-flex align-items-center" style="background: rgba(255, 102, 0, 0.1); color: #ff6600; border: none; border-radius: 8px;">
        <i class="fas fa-cog me-2 fs-7"></i>
        <span class="fs-7">Settings</span>
      </button>
    </div>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="sidebar-logout-btn btn w-100 py-2 d-flex align-items-center justify-content-center fs-6 position-relative" style="background: linear-gradient(135deg, #ff6600 0%, #ff9933 100%); color: #ffffff; border: none; border-radius: 8px; overflow: hidden;">
        <i class="fas fa-sign-out-alt me-2 fs-6"></i>
        <span class="sidebar-logout-text">Sign Out</span>
      </button>
    </form>
  </div>
</div>

<style>
/* Base Sidebar Styles - White & Orange Theme */
.sidebar {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

/* Glass Morphism Effect */
.sidebar-header, .sidebar-footer {
  background: rgba(255, 255, 255, 0.95) !important;
  backdrop-filter: blur(12px);
}

/* Logo Animation */
.sidebar-logo-icon {
  transition: all 0.3s ease;
  transform-origin: center;
}

.sidebar-logo-icon:hover {
  transform: rotate(15deg) scale(1.1);
  box-shadow: 0 0 20px rgba(255, 102, 0, 0.2) !important;
}

/* User Profile */
.sidebar-user-profile {
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.sidebar-user-profile:hover {
  background: rgba(255, 102, 0, 0.05) !important;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255, 102, 0, 0.1);
}

.sidebar-user-avatar {
  transition: all 0.3s ease;
}

.sidebar-user-profile:hover .sidebar-user-avatar {
  transform: scale(1.1);
  border-color: #ff9933 !important;
  box-shadow: 0 0 15px rgba(255, 102, 0, 0.2);
}

/* Quick Actions */
.quick-actions button {
  transition: all 0.3s ease;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.quick-actions button:hover {
  transform: translateY(-2px);
  background: rgba(255, 102, 0, 0.15) !important;
  box-shadow: 0 5px 15px rgba(255, 102, 0, 0.1);
}

/* Navigation Items */
.sidebar-nav-link {
  position: relative;
  transition: all 0.3s ease;
  overflow: hidden;
  border-radius: 8px;
}

.sidebar-nav-link:hover, 
.sidebar-nav-link.active {
  background: rgba(255, 102, 0, 0.05) !important;
  color: #ff6600 !important;
  transform: translateX(5px);
}

.sidebar-nav-link:hover .sidebar-nav-icon, 
.sidebar-nav-link.active .sidebar-nav-icon {
  transform: rotate(5deg) scale(1.1);
  background: rgba(255, 102, 0, 0.2) !important;
}

.sidebar-nav-link:hover .sidebar-nav-text, 
.sidebar-nav-link.active .sidebar-nav-text {
  transform: translateX(5px);
  color: #ff6600 !important;
}

.sidebar-nav-link:hover .badge, 
.sidebar-nav-link.active .badge {
  transform: scale(1.1);
}

.nav-highlight {
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.3s ease, opacity 0.3s ease;
  opacity: 0;
  border-radius: 0 4px 4px 0;
}

.sidebar-nav-link:hover .nav-highlight,
.sidebar-nav-link.active .nav-highlight {
  transform: scaleY(1);
  opacity: 1;
}

/* Icon Animation */
.sidebar-nav-icon {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Text Elements */
.sidebar-nav-text {
  transition: all 0.3s ease;
}

/* Logout Button */
.sidebar-logout-btn {
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.sidebar-logout-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: all 0.7s ease;
}

.sidebar-logout-btn:hover {
  background: linear-gradient(135deg, #e65c00 0%, #ff8533 100%) !important;
  box-shadow: 0 5px 20px rgba(255, 102, 0, 0.2);
  transform: translateY(-2px);
}

.sidebar-logout-btn:hover::before {
  left: 100%;
}

/* Scrollbar Styling */
.sidebar-menu::-webkit-scrollbar {
  width: 6px;
}

.sidebar-menu::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.05);
  border-radius: 3px;
}

.sidebar-menu::-webkit-scrollbar-thumb {
  background: linear-gradient(#ff6600, #ff9933);
  border-radius: 3px;
}

/* Dropdown Menu Styling */
.dropdown-menu {
  border: 1px solid rgba(255, 102, 0, 0.1) !important;
}

.dropdown-item:hover {
  background: rgba(255, 102, 0, 0.05) !important;
  color: #ff6600 !important;
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
  .sidebar {
      width: 260px;
  }
}

@media (max-width: 992px) {
  .sidebar {
      position: fixed;
      left: -280px;
      top: 0;
      z-index: 1050;
      transition: all 0.3s ease;
  }
  
  .sidebar.active {
      left: 0;
  }
  
  .sidebar-header {
      padding: 1rem !important;
  }
  
  .sidebar-user-profile {
      padding: 1rem !important;
  }
}

/* Floating Animation */
@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
  100% { transform: translateY(0px); }
}

.sidebar-logo-icon {
  animation: float 4s ease-in-out infinite;
}
</style>