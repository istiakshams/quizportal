<?php
namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;

use App\Models\User;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display blog list.
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $categories = BlogCategory::get();
        return view('backend.blogs.create', compact(['categories', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {        
        $attributes = $request->validated();

        // Prepare slug
        $slug = Str::slug($attributes['title'], '-');
        $latestSlug = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
        if($latestSlug) {
          $pieces = explode('-', $latestSlug);
          $number = intval(end($pieces));
          $slug .= '-' . ($number + 1);
        }
        $attributes['slug'] = $slug;

        // Is Featured
        $attributes['is_featured'] = isset($attributes['is_featured']) ? 1 : 0;
        // dd($attributes);
        
        $blog = Blog::create($attributes);
        $blog->categories()->attach($attributes['categories']);
        return redirect('/admin/blogs/'.$blog->id.'/edit')->with('message', 'New blog added successfully!');
        // return redirect()->back()->with('message', 'New blog added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {                
        $blog = Blog::findOrFail($id);
        $users = User::get();
        $categories = BlogCategory::get();

        $blogCategories = array();
        $currentCategories = $blog->categories->toArray();
        foreach( $currentCategories as $cat ) {
            $blogCategories[] = $cat['id'];
        }        
        // dd($blogCategories);

        return view('backend.blogs.edit', compact('blog','categories','blogCategories','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        $attributes = $request->validated();
        $blog = Blog::findOrFail($id);

        // Update slug if title has changed
        if( $blog->title != $attributes['title']) {
            $slug = Str::slug($attributes['title'], '-');
            $latestSlug = Blog::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
            if($latestSlug) {
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces));
            $slug .= '-' . ($number + 1);
            }
            $attributes['slug'] = $slug;
        }

        // Is Featured
        $attributes['is_featured'] = isset($attributes['is_featured']) ? 1 : 0;
        // dd($attributes);
        
        $blog->update($attributes);
        $blog->categories()->sync($attributes['categories']);
        return redirect()->back()->with('message', 'Blog updated successfully!');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('message', 'Blog deleted successfully!');
    }
}
