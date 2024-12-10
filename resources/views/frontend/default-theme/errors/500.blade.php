@extends('front.layouts.master')

@section('title', '500 '. getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include('front.header')
@endsection

@section('content')
<!-- Start block -->
<section class="section-white">
  <div class="content-wrap">
    <div class="col">
      <h1 class="page-title">500</h1>
      <h2>Sorry! Page not found...<h2>
    </div>
  </div>
</section>
<!-- End block -->
@endsection

@section('footer')
@include('front.footer')
@endsection