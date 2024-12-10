<div class="widget-recent-posts">
    <h2>Recent Posts</h2>
    @foreach( $blogs as $blog )
    <div class="recent-posts-items">
        <div class="recent-posts-featured-image">
            <a href="/blog/{{ $blog->slug }}"><img src="{{ getFeaturedImage($blog->featured_image) }}"
                    alt="{{ $blog->title }}" /></a>
        </div> <!-- featured-wrap -->
        <div class="recent-posts-blog-title">
            <h3><a href="/blog/{{ $blog->slug }}">{{ $blog->title }}</a></h3>
        </div> <!-- blog-title -->
    </div> <!-- blog-item -->
    @endforeach

</div>