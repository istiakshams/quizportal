<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>@yield('title', getThemeSetting('system_title'))</title>
  <meta name="description" content="@yield('seo_description', getSetting('meta_description', ''))">
  <meta name="keywords" content="{{ getSetting('meta_keywords', '') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/default-theme/app.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  @yield('og')

  @if( getSetting('enable_google_analytics') )
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ getSetting('google_analytics_tracking_id') }}">
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ getSetting('google_analytics_tracking_id') }}');
  </script>
  @endif
  @php
  if( !empty(getSetting('custom_css')) )
    echo '<style> '. getSetting('custom_css') .'</style>';
  @endphp
  @php
  if( !empty(getSetting('header_custom_script')) )
    echo getSetting('header_custom_script');
  @endphp
</head>

<body>
  <div class="qp-wrapper">

    @hasSection('header')
    <div class="qp-fullwidth-container qp-header-container">
      @yield('header')
    </div>
    @endif

    @yield('content')

    <div class="qp-fullwidth-container qp-footer-container">
      @hasSection('footer')
      @yield('footer')
      @endif
    </div>

  </div>

  @php
  if( !empty(getSetting('footer_custom_script')) )
    echo getSetting('footer_custom_script');
  @endphp
  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/default-theme/app.js') }}"></script>
  @yield('scripts')
</body>

</html>