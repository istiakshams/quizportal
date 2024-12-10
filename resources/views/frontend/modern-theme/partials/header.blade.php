<div class="qp-container">
  <div class="qp-header">
    <nav class="relative py-2 flex justify-between items-center bg-white">
      <div class="qp-site-logo">
        <a href="/">
          <img src="{{ getHeaderLogo() }}" alt="" />
        </a>
      </div>
      {{-- Hamburger Menu Icon --}}
      <div class="lg:hidden">
        <button class="qp-navbar-burger flex items-center text-black p-1" id="navbar_burger">
          <svg class="block h-6 w-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <title>Mobile Menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
          </svg>
        </button>
      </div>
      <ul class="qp-nav-links">
        <li><a href="/" class="qp-nav-link">Home</a>
        <li><a href="/blog" class="qp-nav-link">Blog</a>
        <li><a href="/about-us" class="qp-nav-link">About Us</a>
        <li><a href="/contact-us" class="qp-nav-link">Contact Us</a>
        </li>
      </ul>
      <div class="qp-nav-buttons">
        <?php if( Auth::user() ) { ?>
        <?php if( Auth::user()->isAdmin() ) { ?>
        <a href="/admin/home" class="qp-nav-btn">Admin Dashboard</a>
        <?php } ?>
        <a href="/profile" class="qp-nav-btn">Profile</a>
        <a href="#" class="qp-nav-btn"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <?php } else { ?>
        <a href="/register" class="qp-nav-btn">Register</a>
        <a href="/login" class="qp-nav-btn">Login</a>
        <?php } ?>
      </div>
    </nav>

    <!-- mobile navbar -->
    <div class="qp-navbar-menu relative z-50 hidden">
      <div class="qp-navbar-backdrop"></div>
      <nav class="qp-mobile-nav-slider">
        <div class="qp-mobile-nav-header">
          <div class="qp-site-logo">
            <a href="/">
              <img src="{{ asset('images/site-logo.png') }}" alt="" />
            </a>
          </div>

          <button class="qp-navbar-close">
            <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
              </path>
            </svg>
          </button>
        </div>
        <div class="qp-mobile-nav-links">
          <ul>
            <li><a href="/" class="qp-nav-link">Home</a>
            <li><a href="/blog" class="qp-nav-link">Blog</a>
            <li><a href="/about-us" class="qp-nav-link">About Us</a>
            <li><a href="/contact-us" class="qp-nav-link">Contact Us</a>
            </li>
          </ul>
        </div>
        <div class="qp-mobile-nav-footer">
          <?php if( Auth::user() ) { ?>
          <a href="/profile" class="qp-nav-btn">Profile</a>
          <a href="#" class="qp-nav-btn"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="/logout" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
          <?php } else { ?>
          <a href="/register" class="qp-nav-btn">Register</a>
          <a href="/login" class="qp-nav-btn">Login</a>
          <?php } ?>
        </div>
      </nav>
    </div>
  </div><!-- ./qp-header -->
</div> <!-- ./qp-container -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    
        // open
        const burger = document.querySelectorAll('.qp-navbar-burger');
        const menu = document.querySelectorAll('.qp-navbar-menu');
        
        if (burger.length && menu.length) {                
            for (var i = 0; i < burger.length; i++) {
                burger[i].addEventListener('click', function () {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
        
        // close
        const close = document.querySelectorAll('.qp-navbar-close');
        const backdrop = document.querySelectorAll('.qp-navbar-backdrop');

        if (close.length) {
            for (var i = 0; i < close.length; i++) {
                close[i].addEventListener('click', function () {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
        
        if (backdrop.length) {                
            for (var i = 0; i < backdrop.length; i++) {
                backdrop[i].addEventListener('click', function () {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
    });
</script>