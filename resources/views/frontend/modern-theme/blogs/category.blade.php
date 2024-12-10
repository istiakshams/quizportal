@extends( getThemePath() . '.layout.master')

@section('title', $category->meta_title ? $category->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $category->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $category->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-fullwidth-container">
    <div class="qp-container">

        @foreach( $blogs as $blog )

        <div class="qp-blog-item">

            <div class="qp-blog-featured-image">
                <img src="{{ getFeaturedImage($blog->featured_image) }}" alt="{{ $blog->title }}" />
            </div> <!-- qp-featured-wrap -->

            <div class="qp-blog-excerpt">
                <h1><a href="/blog/{{ $blog->slug }}">{{ $blog->title }}</a></h1>
                <div class="qp-blog-meta">
                    <p>By {{ $blog->author() }} - In {{ getBlogCategories($blog->categories()) }} - Published {{
                        Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</p>
                </div> <!-- qp-blog-title -->

                <p>{{ $blog->short_description }}</p>

                <a href="/blog/{{ $blog->slug }}" class="qp-btn-blue">Read More</a>
            </div> <!-- qp-blog-title -->

        </div> <!-- qp-blog-item -->
        @endforeach

    </div> <!-- qp-container -->
</div> <!-- qp-fullwidth-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection