<?php

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
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
     * Show bulk newsletter page
     */
    public function sendNewsletter()
    {
        return view('backend.newsletters.index');
    }

    /**
     * Show Subscribers page
     */
    public function showSubscribers()
    {
        return view('backend.newsletters.subscribers');
    }

    
}
