@extends( getThemePath() . '.layout.master')

@section('title', '404 '. getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-container">

  <div class="qp-page-title">
    <h1>404</h1>
  </div> <!-- qp-page-title -->
  <div class="qp-page-content">
    <h2 class="page-title mb-12 text-center">Sorry, Page Not Found!</h2>
  </div> <!-- qp-page-content -->

</div> <!-- qp-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection