@extends( getThemePath() . '.layout.master')

@section('title', getSetting('site_name') . ' Member Dashboard')

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-container">

    <div class="qp-page-title">
        <h1>{{ $page->title }}</h1>
    </div> <!-- qp-page-title -->
    <div class="qp-page-content">
        {!! $page->content !!}
    </div> <!-- qp-page-content -->

</div> <!-- qp-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection