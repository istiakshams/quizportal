<?php

namespace Modules\Quiz\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Quiz\Http\Requests\PollStoreRequest;
use Modules\Quiz\Http\Requests\PollUpdateRequest;

use App\Models\User;
use Modules\Quiz\Models\Poll;
use Modules\Quiz\Models\PollChoice;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polls = Poll::get();

        return view('quiz::backend.poll.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        return view('quiz::backend.poll.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PollStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);
        
        $attributes['maxCheck'] = isset($attributes['maxCheck']) ? 1 : 0;
        $attributes['canVisitorsVote'] = isset($attributes['canVisitorsVote']) ? 1 : 0;
                // dd($attributes);

        $poll = Poll::create($attributes);

        // Add Choices
        if( is_array($attributes['choices']) ) {
            foreach( $attributes['choices'] as $choice ) {
                $pollChoice = new PollChoice();
                $pollChoice->name = $choice;
                $pollChoice->poll_id = $poll->id;
                $pollChoice->save();
            }
        }
        return redirect()->back()->with('message', 'New poll added successfully!');
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
        $poll = Poll::findOrFail($id);
        $users = User::get();
        
        return view('quiz::backend.poll.edit', compact('poll', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PollUpdateRequest $request, $id)
    {                
        $attributes = $request->validated();
        // dd($attributes);
        $poll = Poll::findOrFail($id);

        $attributes['maxCheck'] = isset($attributes['maxCheck']) ? 1 : 0;
        $attributes['canVisitorsVote'] = isset($attributes['canVisitorsVote']) ? 1 : 0;
        $poll->update($attributes);

        return redirect()->back()->with('message', 'Poll updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {                
        $poll = Poll::findOrFail($id);
        $poll->delete();

        return redirect()->back()->with('message', 'Poll deleted successfully!');
    }
}
