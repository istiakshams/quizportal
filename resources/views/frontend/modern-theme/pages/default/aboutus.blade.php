@extends( getThemePath() . '.layout.master')

@section('title', $page->meta_title ? $page->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $page->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $page->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-container">

    <div class="qp-page-title">
        <h1>{{ $page->title }}</h1> Home
    </div> <!-- qp-page-title -->
    <div class="qp-page-content">
        {!! $page->content !!}
    </div> <!-- qp-page-content -->

</div> <!-- qp-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection