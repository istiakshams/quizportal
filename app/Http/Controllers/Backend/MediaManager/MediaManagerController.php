<?php

namespace App\Http\Controllers\Backend\MediaManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaManagerController extends Controller
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
     * Display Media manager.
     */
    public function index()
    {
        return view('backend.mediamanager.index');
    }
}
