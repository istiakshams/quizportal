@extends('front.layouts.master')

@section('title', '500 '. getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include('front.header')
@endsection

@section('content')
<div class="content-wrap">

  <div class="page-section">
    <h1 class="page-title mb-12 text-center">500</h1>
    <h2 class="page-title mb-12 text-center">Sorry, Page Not Found!</h2>
  </div>

</div>
@endsection

@section('footer')
@include('front.footer')
@endsection