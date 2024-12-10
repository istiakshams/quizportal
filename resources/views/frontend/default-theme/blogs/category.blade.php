@extends( getThemePath() . '.layout.master')

@section('title', $category->meta_title ? $category->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $category->name .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $category->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')
<!-- Start block -->
<section class="section-white">
    <div class="content-wrap">
        <div class="col">
            <h1 class="page-title">{{ $category->name }}</a>
        </div>
        <div class="col-two-third">
            @if( !empty($blogs) )
            @foreach( $blogs as $blog )
            <div class="blog-items">
                <div class="featured-image">
                    <a href="/blog/{{ $blog->slug }}"><img src="{{ getFeaturedImage($blog->featured_image) }}"
                            alt="{{ $blog->title }}" /></a>
                </div> <!-- featured-wrap -->
                <div class="blog-excerpt">
                    <h2><a href="/blog/{{ $blog->slug }}">{{ $blog->title }}</a></h2>
                    <div class="blog-meta">
                        <p>By {{ $blog->author() }} - In {{ getBlogCategories($blog->categories()) }} - Published {{
                            Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</p>
                    </div> <!-- blog-title -->

                    <p>{{ $blog->short_description }}</p>

                    <!-- <a href="/blog/{{ $blog->slug }}" class="btn btn-blue">Read More</a> -->
                </div> <!-- blog-title -->
            </div> <!-- blog-item -->
            @endforeach
            @else
            <h2>No posts found!</h2>
            @endif
        </div>
        <div class="col-one-third">
            @widget('recentPosts')
        </div>
    </div>
</section>
<!-- End block -->
@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection