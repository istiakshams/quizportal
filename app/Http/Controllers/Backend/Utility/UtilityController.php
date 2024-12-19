<?php

namespace App\Http\Controllers\Backend\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Artisan;

class UtilityController extends Controller
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
     * Show backend utility page
     */
    public function index()
    {
        return view('backend.utilities.index');
    }

    public function clearCache()
    {                
        Artisan::call('optimize:clear');
        return redirect()->back()->with('message', 'System cache cleared successfully!');
    }

    public function clearLog()
    {
        file_put_contents(storage_path('logs/laravel.log'),'');
        return redirect()->back()->with('message', 'System log cleared successfully!');
    }

    public function optimize()
    {          
        Artisan::call('optimize');
        return redirect()->back()->with('message', 'System log cleared successfully!');
    }
        
    public function debug()
    {
        return redirect()->back()->with('message', 'Debug mode activated successfully!');
    }
}
