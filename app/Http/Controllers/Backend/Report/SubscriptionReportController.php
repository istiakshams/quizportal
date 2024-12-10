<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionReportController extends Controller
{
    /**
     * Display Subscription Report Page
     */
    public function showSubscriptionReport()
    {
        return view('backend.report.subscription-report');
    }

}
