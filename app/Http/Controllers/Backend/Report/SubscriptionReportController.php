<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionReportController extends Controller
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
     * Display Subscription Report Page
     */
    public function showSubscriptionReport()
    {
        return view('backend.report.subscription-report');
    }

}
