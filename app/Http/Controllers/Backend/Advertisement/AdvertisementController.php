<?php

namespace App\Http\Controllers\Backend\Advertisement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                
        $advertisements = Advertisement::get();
        return view('backend.advertisements.index', compact('advertisements'));
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
        if( empty($request->title) ) {
            return response()->json(['error'=>'Please enter Ad Title!'], 404);            
        }
        if( empty($request->content) ) {
            return response()->json(['error'=>'Please enter Ad Content!'], 404);            
        }

        Advertisement::updateOrCreate([
            'id' => $request->id
        ],
        [
            'title' => $request->title, 
            'content' => $request->content
        ]);

        $advertisements = Advertisement::get();
        return response()->json([
            'success'=> 'Advertise saved successfully.',
            'datatable' => view('backend.advertisements.partials.datatable', compact('advertisements'))->render(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $advertisement = Advertisement::find($id);
        return response()->json($advertisement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();

                
        $advertisements = Advertisement::get();
        return response()->json([
            'success'=> 'Advertisement deleted successfully.',
            'datatable' => view('backend.advertisements.partials.datatable', compact('advertisements'))->render(),
        ]);
    }
}
