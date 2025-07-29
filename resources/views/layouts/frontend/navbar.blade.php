<nav class="navbar navbar-expand-lg">
  <div class="container">
    <!-- Brand Logo with Soccer Ball Animation -->
    <a class="navbar" href="{{ route('index') }}">
      <div class="logo-wrapper">
        <div class="logo-icon">
          <i class="fas fa-futbol"></i>
        </div>
        <span class="logo-text">Anak<span>Rawa</span></span>
        <div class="logo-pulse"></div>
      </div>
    </a>

    <!-- Animated Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            <span>Home</span>
            <div class="nav-line"></div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#fasilitas">
            <span>Fasilitas</span>
            <div class="nav-line"></div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#testimoni">
            <span>Testimoni</span>
            <div class="nav-line"></div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tentang">
            <span>Tentang</span>
            <div class="nav-line"></div>
          </a>
        </li>
      </ul>

      <!-- User Section -->
      <div class="user-section">
        @auth
        <div class="user-dropdown">
          <div class="user-trigger">
            <div class="user-avatar">
              <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF7B25&color=fff" alt="User">
            </div>
            <span class="user-name">{{ Auth::user()->name }}</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="dropdown-menu">
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('member.dashboard') }}" class="dropdown-item">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user-cog"></i> Settings
            </a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i> Logout
              </button>
            </form>
          </div>
        </div>
        @endauth
        @guest
        <div class="auth-dropdown">
          <button class="auth-trigger btn btn-outline-light">
            <i class="fas fa-user-circle me-2"></i>
            Login
            <i class="fas fa-chevron-down ms-1"></i>
          </button>
          <div class="auth-dropdown-menu">
            <a href="{{ route('login') }}" class="dropdown-item">
              <div class="icon-wrapper bg-primary-soft">
                <i class="fas fa-sign-in-alt text-primary"></i>
              </div>
              <div>
                <div class="title">Login</div>
                <small class="text-muted">Access your account</small>
              </div>
            </a>
            @if (Route::has('register'))
            <div class="dropdown-divider"></div>
            <a href="{{ route('register') }}" class="dropdown-item">
              <div class="icon-wrapper bg-success-soft">
                <i class="fas fa-user-plus text-success"></i>
              </div>
              <div>
                <div class="title">Register</div>
                <small class="text-muted">Create new account</small>
              </div>
            </a>
            @endif
          </div>
        </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<style>
:root {
  --primary: #FF7B25;
  --primary-dark: #E56A1B;
  --text: #2b2d42;
  --text-light: #6c757d;
  --white: #ffffff;
  --gray-light: #f8f9fa;
  --transition: all 0.3s ease;
  --dark-bg: #0A0F0F;
}

/* Base Navbar */
.navbar {
  padding: 1rem 0;
  background: var(--dark-bg);
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 2px solid var(--primary);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

/* Logo Styles */


.logo-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.logo-icon {
  width: 40px;
  height: 40px;
  background: var(--primary);
  color: var(--white);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
  transition: var(--transition);
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

.logo-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: #eee;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-family: 'Poppins', sans-serif;
}

.logo-text span {
  color: var(--primary);
  font-weight: 800;
}

.logo-pulse {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 50px;
  height: 50px;
  background: rgba(255, 123, 37, 0.1);
  border-radius: 50%;
  opacity: 0;
  transition: var(--transition);
  z-index: -1;
}

.navbar-brand:hover .logo-icon {
  transform: rotate(360deg);
}

.navbar-brand:hover .logo-pulse {
  opacity: 1;
  width: 60px;
  height: 60px;
}

/* Hamburger Menu */
.hamburger {
  width: 24px;
  height: 16px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  cursor: pointer;
}

.hamburger span {
  display: block;
  width: 100%;
  height: 3px;
  background: var(--primary);
  transition: var(--transition);
  transform-origin: left center;
}

.navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(1) {
  transform: rotate(45deg) translateY(-2px);
}

.navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(2) {
  opacity: 0;
}

.navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(3) {
  transform: rotate(-45deg) translateY(2px);
}

/* Nav Links */
.navbar-nav {
  display: flex;
  align-items: center;
}

.nav-item {
  margin: 0 1rem;
  position: relative;
}

.nav-link {
  position: relative;
  color: #eee;
  font-weight: 600;
  padding: 0.5rem 0;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-transform: uppercase;
  font-size: 0.9rem;
  letter-spacing: 1px;
}

.nav-link span {
  position: relative;
  z-index: 1;
  transition: var(--transition);
}

.nav-link:hover span {
  color: var(--primary);
}

.nav-line {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 3px;
  background: var(--primary);
  transition: var(--transition);
  border-radius: 3px;
}

.nav-link:hover .nav-line,
.nav-link.active .nav-line {
  width: 100%;
}

/* User Dropdown */
.user-dropdown {
  position: relative;
}

.user-trigger {
  display: flex;
  align-items: center;
  cursor: pointer;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: var(--transition);
  background: rgba(255, 123, 37, 0.1);
}

.user-trigger:hover {
  background: rgba(255, 123, 37, 0.2);
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 10px;
  border: 2px solid var(--primary);
}

.user-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.user-name {
  font-weight: 500;
  margin-right: 8px;
  color: #eee;
}

.user-dropdown i {
  font-size: 0.8rem;
  transition: var(--transition);
  color: var(--primary);
}

.user-dropdown.active i {
  transform: rotate(180deg);
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  min-width: 200px;
  background: var(--dark-bg);
  border-radius: 8px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
  padding: 0.5rem 0;
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: var(--transition);
  z-index: 100;
  border: 1px solid rgba(255, 123, 37, 0.2);
}

.user-dropdown.active .dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 0.75rem 1.5rem;
  color: #eee;
  text-decoration: none;
  transition: var(--transition);
}

.dropdown-item i {
  margin-right: 10px;
  color: var(--primary);
}

.dropdown-item:hover {
  background: rgba(255, 123, 37, 0.1);
  color: var(--primary);
}

.dropdown-divider {
  height: 1px;
  background: rgba(255, 255, 255, 0.1);
  margin: 0.5rem 0;
}

/* Auth Buttons */
.auth-dropdown {
  position: relative;
  display: inline-block;
}

.auth-trigger {
  display: flex;
  align-items: center;
  padding: 0.5rem 1.25rem;
  border-radius: 8px;
  transition: all 0.3s ease;
  background: transparent;
  color: #eee;
  border: 2px solid var(--primary);
  font-weight: 600;
}

.auth-trigger:hover {
  background-color: var(--primary);
  color: #000;
}

.auth-trigger i:last-child {
  transition: transform 0.3s ease;
}

.auth-dropdown.active .auth-trigger i:last-child {
  transform: rotate(180deg);
}

.auth-dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  min-width: 240px;
  background: var(--dark-bg);
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  padding: 0.5rem 0;
  margin-top: 8px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: all 0.3s ease;
  z-index: 100;
  border: 1px solid rgba(255, 123, 37, 0.2);
}

.auth-dropdown.active .auth-dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 0.75rem 1.25rem;
  text-decoration: none;
  color: #eee;
  transition: all 0.2s ease;
}

.dropdown-item:hover {
  background-color: rgba(255, 123, 37, 0.1);
}

.icon-wrapper {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 12px;
  flex-shrink: 0;
}

.bg-primary-soft {
  background-color: rgba(255, 123, 37, 0.1);
}

.bg-success-soft {
  background-color: rgba(40, 167, 69, 0.1);
}

.dropdown-item .title {
  font-weight: 500;
  margin-bottom: 2px;
}

.dropdown-item .text-muted {
  color: #aaa;
  font-size: 0.8rem;
}

.dropdown-divider {
  height: 1px;
  background-color: rgba(255, 255, 255, 0.1);
  margin: 0.5rem 0;
}

/* Responsive */
@media (max-width: 991.98px) {
  .navbar-collapse {
    margin-top: 1rem;
    padding: 1rem;
    background: var(--dark-bg);
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 123, 37, 0.2);
  }
  
  .navbar-nav {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .nav-item {
    margin: 0.5rem 0;
    width: 100%;
  }
  
  .nav-link {
    padding: 0.75rem 0;
  }
  
  .user-section {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .auth-buttons {
    flex-direction: column;
    gap: 8px;
  }
  
  .btn {
    width: 100%;
    text-align: center;
  }
}

/* Animation for soccer ball */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.navbar-brand:hover .logo-icon i {
  animation: spin 1s linear;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle dropdown
  const userDropdowns = document.querySelectorAll('.user-dropdown');
  
  userDropdowns.forEach(dropdown => {
    const trigger = dropdown.querySelector('.user-trigger');
    
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      dropdown.classList.toggle('active');
      
      // Close other dropdowns
      userDropdowns.forEach(otherDropdown => {
        if (otherDropdown !== dropdown) {
          otherDropdown.classList.remove('active');
        }
      });
    });
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.user-dropdown')) {
      userDropdowns.forEach(dropdown => {
        dropdown.classList.remove('active');
      });
    }
  });

  const authDropdown = document.querySelector('.auth-dropdown');
  const authTrigger = document.querySelector('.auth-trigger');

  if (authTrigger) {
    authTrigger.addEventListener('click', function(e) {
      e.preventDefault();
      authDropdown.classList.toggle('active');
      
      // Close when clicking outside
      document.addEventListener('click', function outsideClick(e) {
        if (!authDropdown.contains(e.target)) {
          authDropdown.classList.remove('active');
          document.removeEventListener('click', outsideClick);
        }
      });
    });
  }
  
  // Add scroll effect
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 10) {
      navbar.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.2)';
      navbar.style.background = 'rgba(10, 15, 15, 0.95)';
    } else {
      navbar.style.boxShadow = 'none';
      navbar.style.background = 'var(--dark-bg)';
    }
  });
  
  // Add active class to current page link
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-link').forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });
});
</script>