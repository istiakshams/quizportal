<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\BlogCategoryStoreRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;

use App\Models\User;
use App\Models\Blog;
use App\Models\BlogCategory;


class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::get();
        return view('backend.blogcategories.index', compact('categories'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryStoreRequest $request)
    {
        $attributes = $request->validated();

        // Prepare slug
        $slug = Str::slug($attributes['name'], '-');
        $latestSlug = BlogCategory::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
        if($latestSlug) {
          $pieces = explode('-', $latestSlug);
          $number = intval(end($pieces));
          $slug .= '-' . ($number + 1);
        }
        $attributes['slug'] = $slug;

        BlogCategory::create($attributes);

        return redirect()->back()->with('message', 'New category added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('backend.blogcategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $attributes = $request->validated();
        $category = BlogCategory::findOrFail($id);

        // Update slug if title has changed
        if( $category->name != $attributes['name']) {
            $slug = Str::slug($attributes['name'], '-');
            $latestSlug = BlogCategory::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
            if($latestSlug) {
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces));
            $slug .= '-' . ($number + 1);
            }
            $attributes['slug'] = $slug;
        }

        $category->update($attributes);

        return redirect()->back()->with('message', 'Category details updated successfully!');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('message', 'Category deleted successfully!');
    }
}
