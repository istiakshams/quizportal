@extends( getThemePath() . '.layout.master')

@section('title', $blog->meta_title ? $blog->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $blog->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $blog->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')
<!-- Start block -->
<section class="section-white">
    <div class="content-wrap">
        <div class="col">
            <div class="featured-image single-featured">
                <img src="{{ getFeaturedImage($blog->featured_image) }}" alt="{{ $blog->title }}" />
            </div> <!-- featured-wrap -->
        </div>
        <div class="col-two-third">
            <h1 class="blog-title">{{ $blog->title }}</a></h1>
            <div class="blog-meta">
                <p>By {{ $blog->author() }} - In {{ getBlogCategories($blog->categories()) }} - Published {{
                    Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</p>
            </div> <!-- blog-title -->
            <div class="blog-content">
                {!! $blog->description !!}
            </div> <!-- blog-content -->
        </div>
        <div class="col-one-third">
            @widget('recentPosts')
        </div>
    </div> <!-- content-wrap -->
</section> <!-- section-white -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection