<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Models\Blog;
use App\Models\BlogCategory;

class RecentPosts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $blogs = '';
        $blogs = Blog::where('status', 'published')->get();
        
        return view('widgets.recent_posts', [
            'config' => $this->config,
            'blogs' => $blogs,
        ]);
    }
}
