@extends( getThemePath() . '.layout.master')

@section('title', $page->meta_title ? $page->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $page->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')
<section class="section-white">
    <div class="content-wrap">
        <div class="col">
            <h1 class="page-title">{{ $page->title }}</h1>
        </div> <!-- col -->
        <div class="col">
            {!! $page->content !!}
        </div> <!-- page-content -->
    </div> <!-- content-wrap -->
</section> <!-- container -->
@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection