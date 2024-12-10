<?php

namespace App\Http\Controllers\Backend\MediaManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaManagerController extends Controller
{
    /**
     * Display Media manager.
     */
    public function index()
    {
        return view('backend.mediamanager.index');
    }
}
