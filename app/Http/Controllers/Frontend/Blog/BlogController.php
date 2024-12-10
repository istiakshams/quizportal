<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display blog archive
     */
    public function index()
    {
        $blogs = Blog::where('status', 'published')->get();
        
        if( $blogs )
        {        
            return view( getThemePath() . '.blogs.index', compact('blogs'));
        }
        else 
        {
            return redirect('/')->withErrors('Page not found!');
        }
    }

    /**
     * Display a single blog post
     */
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        
        if( $blog )
        {
            if( $blog->status == 'draft' )
            {
                return redirect('/')->withErrors('Page not found!');
            }
        }
        else 
        {
            return redirect('/')->withErrors('Page not found!');
        }
        return view( getThemePath() . '.blogs.show', compact('blog'));
    }

    /**
     * Display category archive
     */
    public function categoryArchive(string $slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();
        // dd($category);

        // $blogs = Blog::with(['categories' => function($q) use($category) {
        //     $q->where('blog_category_id', '=', $category->id);
        // }])
        // ->where('status', '=', 'published')
        // ->get();

        $allblogs = $category->blogs;
        $blogs = array();
        foreach( $allblogs as $blog ) {
            if( $blog->status == 'published' ) {
                $blogs[] = $blog;
            }
        }
        // dd( $blogs );
        return view( getThemePath() . '.blogs.category', compact('category', 'blogs'));
    }

}
