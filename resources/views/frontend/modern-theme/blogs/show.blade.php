@extends( getThemePath() . '.layout.master')

@section('title', $blog->meta_title ? $blog->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $blog->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $blog->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-fullwidth-container">
    <div class="qp-container">

        <div class="qp-blog-featured-image">
            <img src="{{ getFeaturedImage($blog->featured_image) }}" alt="{{ $blog->title }}" />
        </div> <!-- qp-featured-wrap -->

        <div class="qp-blog-title">
            <h1>{{ $blog->title }}</h1>
            <div class="qp-blog-meta">
                <p>By {{ $blog->author() }} - In {{ getBlogCategories($blog->categories()) }} - Published {{
                    Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</p>
            </div> <!-- qp-blog-title -->
        </div> <!-- qp-blog-title -->

        <div class="qp-blog-content">
            {!! $blog->description !!}
        </div> <!-- qp-blog-content -->

    </div> <!-- qp-container -->
</div> <!-- qp-fullwidth-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection