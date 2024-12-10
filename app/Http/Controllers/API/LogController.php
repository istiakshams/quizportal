<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReportEmail;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(json_decode($request->getContent(), true));
        
        $data = json_decode($request->getContent(), true);
        $log = new Log();

        // Dummy
        // $log->profile = "";
        // $log->status = $request->getContent();
        // $log->logs = "";
        // $log->errorMessage = "";
        
        $log->profile = $data['profile'];
        $log->status = $data['workflowStatus'];
        $log->logs = json_encode($data['workflowLogs']);
        $log->errorMessage = $data['errorMessage'];

        $log->save();


        // Send Email Report
        Mail::to('istiak2007@gmail.com')->send(new ReportEmail($log->profile, $log->status, $log->errorMessage));

        return response()->json([
            "message" => "Success"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
