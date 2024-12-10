@extends( getThemePath() . '.layout.master')

@section('title', 'Support '. getSetting('tab_separator') .' '. getSetting('system_title'))
@section('seo_description', getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-container">

    <div class="qp-page-title">
        <h1>Support</h1>
    </div> <!-- qp-page-title -->
    <div class="qp-page-content">

    </div> <!-- qp-page-content -->

</div> <!-- qp-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection