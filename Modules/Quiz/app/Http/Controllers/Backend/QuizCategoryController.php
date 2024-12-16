<?php

namespace Modules\Quiz\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Modules\Quiz\Http\Requests\QuizCategoryStoreRequest;
use Modules\Quiz\Http\Requests\QuizCategoryUpdateRequest;

use Modules\Quiz\Models\Quiz;
use Modules\Quiz\Models\QuizCategory;

class QuizCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QuizCategory::get();

        return view('quiz::backend.quizcategories.index', compact('categories'));
    }

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
    public function store(QuizCategoryStoreRequest $request)
    {
        $attributes = $request->validated();

        // Prepare slug
        $slug = Str::slug($attributes['name'], '-');
        $latestSlug = QuizCategory::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
        if($latestSlug) {
          $pieces = explode('-', $latestSlug);
          $number = intval(end($pieces));
          $slug .= '-' . ($number + 1);
        }
        $attributes['slug'] = $slug;

        QuizCategory::create($attributes);

        return redirect()->back()->with('message', 'New quiz category added successfully!');    }

    /**
     * Show the specified resource.
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
        $category = QuizCategory::findOrFail($id);
        return view('quiz::backend.quizcategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizCategoryUpdateRequest $request, $id)
    {
        $attributes = $request->validated();
        $category = QuizCategory::findOrFail($id);

        // Update slug if title has changed
        if( $category->name != $attributes['name']) {
            $slug = Str::slug($attributes['name'], '-');
            $latestSlug = QuizCategory::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
            if($latestSlug) {
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces));
            $slug .= '-' . ($number + 1);
            }
            $attributes['slug'] = $slug;
        }

        $category->update($attributes);

        return redirect()->back()->with('message', 'Quiz category details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {                
        $category = QuizCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('message', 'Quiz category deleted successfully!');
    }
}
