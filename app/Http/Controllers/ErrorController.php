<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function notfound()
    {
        return view(getThemePath() . '.errors.404');
    }

    public function fatal()
    {
        return View::make('500');
    }
}
