<header class="header">
  <nav class="nav">
    <div class="nav-wrapper">
      <a href="/" class="logo-link">
        @if( empty(getThemeSetting('site_logo_dark')) )
        <img src="/images/themes/default-theme/logo-default.png" class="logo" alt="Landwind Logo" />
        <span class="logo-text">{{ getSetting('system_title') }}</span>
        @else
        <img src="{{ getImage(getThemeSetting('site_logo_dark')) }}" alt="{{ getSetting('system_title') }}"
          class="logo" />
        @endif
      </a>
      <div class="flex items-center lg:order-2 space-x-2 justify-end">
        <?php if( Auth::user() ) { ?>
        <?php if( Auth::user()->isAdmin() ) { ?>
        <a href="/admin" class="nav-btn-secondary">Dashboard</a>
        <?php } ?>
        <a href="/profile" class="nav-btn-secondary">Profile</a>
        <a href="#" class="nav-btn"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <?php } else { ?>
        <a href="/register" class="nav-btn-secondary">Register</a>
        <a href="/login" class="nav-btn">Login</a>
        <?php } ?>
        <button data-collapse-toggle="mobile-menu-2" type="button"
          class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div class="nav-menu hidden" id="mobile-menu-2">
        <ul>
          <li>
            <a href="/" aria-current="page">Home</a>
          </li>
          <li>
            <a href="/blog">Blog</a>
          </li>
          <li>
            <a href="/about-us">About Us</a>
          </li>
          <li>
            <a href="/contact-us">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>