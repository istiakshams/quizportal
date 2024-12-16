<?php

namespace Modules\Quiz\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Modules\Quiz\Http\Requests\QuizStoreRequest;
use Modules\Quiz\Http\Requests\QuizUpdateRequest;

use App\Models\User;
use Modules\Quiz\Models\Quiz;
use Modules\Quiz\Models\QuizCategory;
use Modules\Quiz\Models\Result;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::get();

        return view('quiz::backend.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $categories = QuizCategory::get();
        return view('quiz::backend.quiz.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizStoreRequest $request)
    {
        $attributes = $request->validated();
        // dd($attributes);

        // Prepare slug
        $slug = Str::slug($attributes['title'], '-');
        $latestSlug = Quiz::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
        if($latestSlug) {
          $pieces = explode('-', $latestSlug);
          $number = intval(end($pieces));
          $slug .= '-' . ($number + 1);
        }
        $attributes['slug'] = $slug;

        // Is Featured
        $attributes['is_featured'] = isset($attributes['is_featured']) ? 1 : 0;
        // dd($attributes);
        
        $quiz = Quiz::create($attributes);
        // return redirect()->back()->with('message', 'New quiz added successfully!');
        return redirect()->to('/admin/quizzes/'.$quiz->id.'/edit');
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
        $quiz = Quiz::findOrFail($id);                
        $users = User::get();
        $categories = QuizCategory::get();
        
        return view('quiz::backend.quiz.edit', compact('quiz', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $attributes = $request->validated();
        // dd($attributes);                
        $quiz = Quiz::findOrFail($id);
                
        // Update slug if title has changed
        if( $quiz->title != $attributes['title']) {
            $slug = Str::slug($attributes['title'], '-');
            $latestSlug = Quiz::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")->latest('id')->pluck('slug')->first();
            if($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces));
                $slug .= '-' . ($number + 1);
            }
            $attributes['slug'] = $slug;
        }

        // Is Featured
        $attributes['is_featured'] = isset($attributes['is_featured']) ? 1 : 0;
        // dd($attributes);
        $quiz->update($attributes);

        // Store/Update Results
        // if( $attributes['type'] == 'personality' ) {
        //     // Result 1
        //     $result_1 = Result::where([['quiz_id', $quiz->id],['result_no', 1]])->first();
        //     if( $result_1 == null ) {
        //         $result = Result::create([
        //                 'quiz_id' => $quiz->id, 
        //                 'result_no' => 1, 
        //                 'text' => $attributes['result_1'],
        //                 'image' => $attributes['result_1_image']
        //         ]);
        //     }
        //     else {
        //         $result_1->update([
        //                 'text' => $attributes['result_1'],
        //                 'image' => $attributes['result_1_image']
        //         ]);
        //     }
                        
        //     // Result 2
        //     $result_2 = Result::where([['quiz_id', $quiz->id],['result_no', 2]])->first();
        //     if( $result_2 == null ) {
        //         $result = Result::create([
        //                 'quiz_id' => $quiz->id, 
        //                 'result_no' => 2, 
        //                 'text' => $attributes['result_2'],
        //                 'image' => $attributes['result_2_image']
        //         ]);
        //     }

        //     // Result 3
        //     $result_3 = Result::where([['quiz_id', $quiz->id],['result_no', 3]])->first();
        //     if( $result_3 == null ) {
        //         $result = Result::create([
        //                 'quiz_id' => $quiz->id, 
        //                 'result_no' => 3, 
        //                 'text' => $attributes['result_3'],
        //                 'image' => $attributes['result_3_image']
        //         ]);
        //     }
                        
        //     // Result 4
        //     if( $attributes['no_of_choices'] > 3 ) {
        //         $result_4 = Result::where([['quiz_id', $quiz->id],['result_no', 4]])->first();
        //         if( $result_4 == null ) {
        //             $result = Result::create([
        //                     'quiz_id' => $quiz->id, 
        //                     'result_no' => 4, 
        //                     'text' => $attributes['result_4'],
        //                     'image' => $attributes['result_4_image']
        //             ]);
        //         }
        //     }
                        
        //     // Result 5
        //     if( $attributes['no_of_choices'] > 4 ) {
        //         $result_5 = Result::where([['quiz_id', $quiz->id],['result_no', 5]])->first();
        //         if( $result_5 == null ) {
        //             $result = Result::create([
        //                     'quiz_id' => $quiz->id, 
        //                     'result_no' => 5, 
        //                     'text' => $attributes['result_5'],
        //                     'image' => $attributes['result_5_image']
        //             ]);
        //         }
        //     }
        // }
        
        return redirect()->back()->with('message', 'Quiz updated successfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->back()->with('message', 'Quiz deleted successfully!');        
    }
}
