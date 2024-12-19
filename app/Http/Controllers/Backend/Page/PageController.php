<?php
namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;

use App\Models\User;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display list of pages.
     */
    public function index()
    {
        $pages = Page::get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        $users = User::get();
        return view('backend.pages.create', compact(['users'])); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
        $attributes = $request->validated();

        // Prepare slug
        $slug = Str::slug($attributes['title'], '-');
        $latestSlug = Page::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
        if($latestSlug) {
          $pieces = explode('-', $latestSlug);
          $number = intval(end($pieces));
          $slug .= '-' . ($number + 1);
        }
        $attributes['slug'] = $slug;

        // dd($attributes);
        
        Page::create($attributes);
        return redirect()->back()->with('message', 'New page added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        // dd($page);
        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $attributes = $request->validated();

        // Update slug if title has changed
        if( $page->title != $attributes['title']) {            
            $slug = Str::slug($attributes['title'], '-');
            $latestSlug = Page::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
            if($latestSlug) {
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces));
            $slug .= '-' . ($number + 1);
            }
            $attributes['slug'] = $slug;        
        }
        // dd($attributes);
        
        $page->update($attributes);
        return redirect()->back()->with('message', 'Page updated successfully!');

    }

    /**
     * Delete a page by ID.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->back()->with('message', 'Page deleted successfully!');
    }
}
