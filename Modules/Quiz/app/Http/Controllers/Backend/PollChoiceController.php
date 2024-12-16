<?php

namespace Modules\Quiz\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Quiz\Models\PollChoice;

class PollChoiceController extends Controller
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
        if( empty($request->name) ) {
            return response()->json(['error'=>'Please enter choice!'], 404);            
        }
        // if( empty($request->votes) ) {
        //     return response()->json(['error'=>'Please enter votes!'], 404);            
        // }
                
        $pollchoice = PollChoice::updateOrCreate([
            'id' => $request->id
        ],
        [
            'poll_id' => $request->poll_id, 
            'name' => $request->name, 
            'votes' => $request->votes
        ]);

        $choices = PollChoice::where('poll_id', $pollchoice->poll_id)->get();
        return response()->json([
            'success'=> 'Poll Choice updated successfully!',
            'choices' => view('quiz::backend.poll.partials.choices', compact('choices'))->render(),
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {                
        $choice = PollChoice::find($id);
        return response()->json($choice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {                
        $choice = PollChoice::findOrFail($id);
        $poll_id = $choice->poll_id;
        $choice->delete();
                
        $choices = PollChoice::where('poll_id', $poll_id)->get();
        return response()->json([
            'success'=> 'Choice deleted successfully.',
            'choices' => view('quiz::backend.poll.partials.choices', compact('choices'))->render(),
        ]);
    }
}
