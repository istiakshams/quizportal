<?php

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
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
