<!-- Premium Glass Morphism Navbar - Orange Theme -->
<nav class="navbar">
  <div class="nav-container">
    <!-- Premium Logo with Animation -->
    <a class="nav-brand" href="{{ route('index') }}">
      <div class="logo">
        <div class="logo-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
            <path d="M12 8v4l3 3"></path>
          </svg>
        </div>
        <span class="brand-name">ANAK<span>RAWA</span>FUTSAL</span>
        <div class="logo-underline"></div>
      </div>
      <div class="logo-pulse"></div>
    </a>

    <!-- Main Navigation -->
    <div class="nav-menu">
      <!-- Search Bar -->
      <div class="nav-search">
    
      </div>

      <!-- Clock -->
      <div class="nav-clock">
        <div class="clock-face">
          <div class="time-display">
              <span class="hours" id="nav-hours">00</span>
              <span class="separator">:</span>
              <span class="minutes" id="nav-minutes">00</span>
              <span class="separator">:</span>
              <span class="seconds" id="nav-seconds">00</span>
          </div>
          <div class="date-display" id="nav-date">Jun 13, 2023</div>
        </div>
      </div>

      <!-- Navigation Items -->
      <div class="nav-items">
        <div class="nav-divider"></div>

        <!-- Enhanced User Dropdown -->
        <div class="nav-item dropdown user-dropdown">
          <div class="user-profile">
            <div class="avatar">
              <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ff6600&color=fff" alt="User Avatar">
              <span class="user-status online"></span>
            </div>
            <div class="user-info">
              <span class="user-name">{{ Auth::user()->name }}</span>
              <span class="user-role">{{ Auth::user()->role }}</span>
            </div>
            <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </div>
          
          <!-- Premium Dropdown Content -->
          <div class="dropdown-content">
            <div class="dropdown-header">
              <div class="avatar large">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ff6600&color=fff" alt="User Avatar">
              </div>
              <div class="header-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
              </div>
              <div class="header-accent"></div>
              <div class="header-bg"></div>
            </div>
            
            <div class="dropdown-items">
              <a href="#" class="dropdown-item">
                <div class="item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
                <span>My Profile</span>
                <div class="item-arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                  </svg>
                </div>
              </a>
              
              <div class="dropdown-divider"></div>
              
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item logout d-flex align-items-center">
                    <div class="item-icon me-2">
                      <!-- SVG here -->
                    </div>
                    <span>Sign Out</span>
                  </button>
                </form>
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navbar Bottom Border with Glow Effect -->
  <div class="navbar-border">
    <div class="border-glow"></div>
  </div>
</nav>

<style>
:root {
  --primary: #ff6600;
  --primary-light: rgba(255, 102, 0, 0.1);
  --primary-dark: #e65c00;
  --primary-gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
  --text: #2b2d42;
  --text-light: #8d99ae;
  --text-lighter: #adb5bd;
  --white: #ffffff;
  --danger: #e63946;
  --danger-light: rgba(230, 57, 70, 0.1);
  --success: #4cc9f0;
  --border: rgba(0, 0, 0, 0.08);
  --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
  --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 15px 35px rgba(0, 0, 0, 0.15);
  --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  --glass: rgba(255, 255, 255, 0.85);
  --glass-border: rgba(255, 255, 255, 0.2);
}

/* Base Navbar Styles */
.navbar {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: var(--glass);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--glass-border);
}

.nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1400px;
  margin: 0 auto;
  padding: 0.5rem 2rem;
  position: relative;
}

/* Enhanced Logo Styles */
.nav-brand {
  display: flex;
  align-items: center;
  text-decoration: none;
  position: relative;
  z-index: 10;
}

.logo {
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
}

.logo-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--primary-gradient);
  border-radius: 12px;
  color: var(--white);
  transition: var(--transition);
  box-shadow: 0 4px 12px rgba(255, 102, 0, 0.3);
}

.logo:hover .logo-icon {
  transform: rotate(15deg) scale(1.1);
  box-shadow: 0 6px 20px rgba(255, 102, 0, 0.4);
}

.logo-icon svg {
  width: 20px;
  height: 20px;
}

.brand-name {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--text);
  letter-spacing: 0.5px;
  position: relative;
  display: flex;
  align-items: center;
}

.brand-name span {
  color: var(--primary);
  margin-left: 4px;
}

.logo-underline {
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 100%;
  height: 2px;
  background: var(--primary-gradient);
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.4s ease;
}

.logo-pulse {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 60px;
  height: 60px;
  background: rgba(255, 102, 0, 0.1);
  border-radius: 50%;
  z-index: -1;
  opacity: 0;
  transition: var(--transition);
}

.nav-brand:hover .logo-underline {
  transform: scaleX(1);
  transform-origin: left;
}

.nav-brand:hover .logo-pulse {
  opacity: 1;
  width: 80px;
  height: 80px;
}

/* Navigation Menu */
.nav-menu {
  display: flex;
  align-items: center;
  gap: 20px;
}

/* Search Bar */
.nav-search {
  position: relative;
  margin-right: 10px;
  width: 240px;
  transition: var(--transition);
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  width: 18px;
  height: 18px;
  color: var(--text-light);
  transition: var(--transition);
}

.search-input {
  width: 100%;
  padding: 0.65rem 1rem 0.65rem 40px;
  border-radius: 10px;
  border: 1px solid var(--border);
  background-color: rgba(255, 255, 255, 0.7);
  font-size: 0.9rem;
  color: var(--text);
  transition: var(--transition);
  box-shadow: var(--shadow-sm);
}

.search-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.2);
}

.search-input:focus + .search-focus-line {
  width: 100%;
}

.search-input::placeholder {
  color: var(--text-lighter);
}

.search-focus-line {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--primary-gradient);
  transition: var(--transition);
}

/* Navigation Items */
.nav-items {
  display: flex;
  align-items: center;
  gap: 12px;
}

.nav-item {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 10px;
  color: var(--text-light);
  transition: var(--transition);
  position: relative;
}

.nav-item:hover {
  color: var(--primary);
  background-color: var(--primary-light);
}

.nav-item svg {
  width: 20px;
  height: 20px;
}

.notification-badge {
  position: absolute;
  top: -2px;
  right: -2px;
  background-color: var(--danger);
  color: white;
  font-size: 0.65rem;
  font-weight: 600;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid var(--white);
}

.nav-divider {
  width: 1px;
  height: 24px;
  background-color: var(--border);
  margin: 0 8px;
}

/* User Dropdown */
.user-dropdown {
  position: relative;
  margin-left: 8px;
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 0.5rem;
  padding-right: 0.8rem;
  border-radius: 10px;
  transition: var(--transition);
  cursor: pointer;
}

.user-profile:hover {
  background-color: var(--primary-light);
}

.user-profile:hover .user-name {
  color: var(--primary);
}

.avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  position: relative;
  flex-shrink: 0;
}

.avatar img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
}

.avatar.large {
  width: 48px;
  height: 48px;
}

.user-status {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid var(--white);
}

.user-status.online {
  background-color: var(--success);
}

.user-info {
  display: flex;
  flex-direction: column;
}

.user-name {
  font-weight: 500;
  color: var(--text);
  transition: var(--transition);
  white-space: nowrap;
  font-size: 0.95rem;
}

.user-role {
  font-size: 0.75rem;
  color: var(--text-light);
  text-transform: capitalize;
}

.dropdown-arrow {
  width: 16px;
  height: 16px;
  color: var(--text-light);
  transition: var(--transition);
  margin-left: 4px;
}

.user-dropdown:hover .dropdown-arrow {
  transform: rotate(180deg);
  color: var(--primary);
}

/* Dropdown Menu */
.dropdown-content {
  position: absolute;
  right: 0;
  top: calc(100% + 10px);
  width: 300px;
  background: var(--glass);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-radius: 14px;
  box-shadow: var(--shadow-xl);
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: var(--transition);
  z-index: 100;
  border: 1px solid var(--glass-border);
  overflow: hidden;
}

.user-dropdown:hover .dropdown-content {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.dropdown-header {
  position: relative;
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 1.5rem;
  overflow: hidden;
}

.header-accent {
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  background: var(--primary-gradient);
}

.header-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(255, 102, 0, 0.1), rgba(255, 102, 0, 0.05));
  opacity: 0.6;
  z-index: -1;
}

.header-info h4 {
  margin: 0;
  font-size: 1.05rem;
  color: var(--text);
  font-weight: 600;
}

.header-info p {
  margin: 4px 0 0;
  font-size: 0.85rem;
  color: var(--text-light);
}

.dropdown-items {
  padding: 0.5rem 0;
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 0.85rem 1.5rem;
  text-decoration: none;
  color: var(--text);
  transition: var(--transition);
  position: relative;
}

.dropdown-item:hover {
  background-color: var(--primary-light);
  color: var(--primary);
}

.item-icon {
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 12px;
  color: var(--text-light);
  transition: var(--transition);
}

.dropdown-item:hover .item-icon {
  color: var(--primary);
}

.item-icon svg {
  width: 18px;
  height: 18px;
}

.item-arrow {
  margin-left: auto;
  opacity: 0;
  transform: translateX(-5px);
  transition: var(--transition);
}

.dropdown-item:hover .item-arrow {
  opacity: 1;
  transform: translateX(0);
}

.item-arrow svg {
  width: 16px;
  height: 16px;
}

.badge {
  margin-left: auto;
  background-color: var(--primary);
  color: white;
  font-size: 0.7rem;
  padding: 0.2rem 0.5rem;
  border-radius: 10px;
  font-weight: 500;
}

.badge.pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(255, 102, 0, 0.4); }
  70% { box-shadow: 0 0 0 8px rgba(255, 102, 0, 0); }
  100% { box-shadow: 0 0 0 0 rgba(255, 102, 0, 0); }
}

.dropdown-divider {
  height: 1px;
  background-color: var(--border);
  margin: 0.5rem 1.5rem;
}

.dropdown-item.logout {
  color: var(--danger);
}

.dropdown-item.logout:hover {
  background-color: var(--danger-light);
}

/* Navbar Border with Glow Effect */
.navbar-border {
  position: relative;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.08), transparent);
}

.border-glow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, var(--primary), transparent);
  opacity: 0;
  transition: var(--transition);
}

.navbar:hover .border-glow {
  opacity: 0.3;
}

/* Navbar Clock Styles */
.nav-clock {
    margin-right: 20px;
    position: relative;
}

.nav-clock .clock-face {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.nav-clock:hover .clock-face {
    background: rgba(255, 255, 255, 0.3);
    box-shadow: 0 0 15px rgba(255, 102, 0, 0.2);
}

.clock-brand {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 1px;
    color: var(--primary);
    text-transform: uppercase;
    margin-bottom: 2px;
}

.nav-clock .time-display {
    display: flex;
    align-items: baseline;
    font-size: 1.1rem;
    font-weight: 500;
    color: var(--text);
}

.nav-clock .hours, 
.nav-clock .minutes {
    min-width: 22px;
    text-align: center;
}

.nav-clock .seconds {
    min-width: 22px;
    text-align: center;
    color: var(--primary);
    font-size: 1rem;
}

.nav-clock .separator {
    animation: blink 1s infinite;
}

.nav-clock .date-display {
    font-size: 0.7rem;
    color: var(--text-light);
    margin-top: 2px;
    letter-spacing: 0.5px;
}

/* Animation for clock separators */
@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Responsive Design */
@media (max-width: 1024px) {
  .nav-search {
    width: 200px;
  }
}

@media (max-width: 768px) {
  .nav-container {
    padding: 0.75rem 1.5rem;
  }
  
  .nav-search {
    display: none;
  }
  
  .user-info {
    display: none;
  }
  
  .dropdown-content {
    width: 280px;
    right: -10px;
  }
}

@media (max-width: 480px) {
  .brand-name span {
    display: none;
  }
  
  .logo-icon {
    width: 36px;
    height: 36px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Dark mode toggle functionality
  const darkModeToggle = document.getElementById('dark-mode-toggle');
  
  // Check for saved user preference
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark-mode');
    darkModeToggle.checked = true;
  }
  
  // Toggle dark mode
  darkModeToggle.addEventListener('change', function() {
    if (this.checked) {
      document.documentElement.classList.add('dark-mode');
      localStorage.setItem('darkMode', 'enabled');
    } else {
      document.documentElement.classList.remove('dark-mode');
      localStorage.setItem('darkMode', 'disabled');
    }
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
      if (!dropdown.contains(event.target)) {
        dropdown.querySelector('.dropdown-content').style.opacity = '0';
        dropdown.querySelector('.dropdown-content').style.visibility = 'hidden';
        dropdown.querySelector('.dropdown-content').style.transform = 'translateY(10px)';
      }
    });
  });
});

// Add this to your existing script
function updateNavClock() {
    const now = new Date();
    
    // Time
    document.getElementById('nav-hours').textContent = now.getHours().toString().padStart(2, '0');
    document.getElementById('nav-minutes').textContent = now.getMinutes().toString().padStart(2, '0');
    document.getElementById('nav-seconds').textContent = now.getSeconds().toString().padStart(2, '0');
    
    // Date
    const options = { month: 'short', day: 'numeric', year: 'numeric' };
    document.getElementById('nav-date').textContent = now.toLocaleDateString('en-US', options);
}

setInterval(updateNavClock, 1000);
updateNavClock();
</script>