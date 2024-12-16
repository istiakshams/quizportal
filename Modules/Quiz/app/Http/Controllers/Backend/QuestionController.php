<?php

namespace Modules\Quiz\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Quiz\Http\Requests\QuestionStoreRequest;
use Modules\Quiz\Http\Requests\QuestionUpdateRequest;

use Modules\Quiz\Models\Quiz;
use Modules\Quiz\Models\Question;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        // dd($quiz->questions );
        return view('quiz::backend.questions.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quiz::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);
        
        $question = Question::create($attributes);
        return redirect()->back()->with('message', 'New question added successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('quiz::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('quiz::edit');
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
        //
    }
}
