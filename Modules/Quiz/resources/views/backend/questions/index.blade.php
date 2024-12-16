@extends('adminlte::page')

@section('title', 'Manage Questions')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Manage Questions</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/quizzes">Quizzes</a> / Manage Questions</p>
    </div> <!-- /.col -->
    <div class="col-md-6">
        <p><a href="/admin/quizzes/{{ $quiz->id }}/edit" class="btn btn-secondary float-right">Back To Edit Quiz</a></p>
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

@if( $quiz->questions->isNotEmpty() )
ADSfsdaf
@foreach( $quiz->questions as $question )

<div class="card card-default">
    <div class="card-body">
        <div class="row" style="align-items:center;">
            <div class="col-md-2">
                <span style="font-weight:600;">Question:</span>
            </div>
            <div class="col-md-8">
                {{ $question->question }}
            </div>
            <div class="col-md-2">
            </div>
        </div>

        <div class="row" style="margin-top:15px;margin-bottom:15px;align-items:center;">
            <div class="col-md-2">
                <span style="font-weight:600;">Choices:</span>
            </div>
            <div class="col-md-8">
                <ul class="list-choices">
                    @if( !empty($question->answer_1_text) )
                    <li>
                        @if( !empty($question->answer_1_image) )
                        <img src="{{ getImage($question->answer_1_image) }}" alt="{{ $question->answer_1_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_1_text }}</p>
                    </li>
                    @endif
                    @if( !empty($question->answer_2_text) )
                    <li>
                        @if( !empty($question->answer_2_image) )
                        <img src="{{ getImage($question->answer_2_image) }}" alt="{{ $question->answer_2_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_2_text }}</p>
                    </li>
                    @endif
                    @if( !empty($question->answer_3_text) )
                    <li>
                        @if( !empty($question->answer_3_image) )
                        <img src="{{ getImage($question->answer_3_image) }}" alt="{{ $question->answer_3_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_3_text }}</p>
                    </li>
                    @endif
                    @if( !empty($question->answer_4_text) )
                    <li>
                        @if( !empty($question->answer_4_image) )
                        <img src="{{ getImage($question->answer_4_image) }}" alt="{{ $question->answer_4_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_4_text }}</p>
                    </li>

                    @endif
                    @if( !empty($question->answer_5_text) )
                    <li>
                        @if( !empty($question->answer_5_image) )
                        <img src="{{ getImage($question->answer_5_image) }}" alt="{{ $question->answer_5_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_5_text }}</p>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-2">
                <div class="row" style="align-items:center;">
                    <div class="col-md-6 text-center">
                        <a href="/admin/questions/{{ $question->id }}/edit" class="btn btn-block btn-primary">Edit</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <form action="/admin/blogs/{{ $question->id }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-block btn-danger">Delete</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="align-items:center;">
            <div class="col-md-2">
                <span style="font-weight:600;">Correct Choice:</span>
            </div>
            <div class="col-md-8">
                <ul class="list-choices">
                    @if( $question->correct_answer == 1 )
                    <li>
                        @if( !empty($question->answer_1_image) )
                        <img src="{{ getImage($question->answer_1_image) }}" alt="{{ $question->answer_1_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_1_text }}</p>
                    </li>
                    @elseif( $question->correct_answer == 2 )
                    <li>
                        @if( !empty($question->answer_2_image) )
                        <img src="{{ getImage($question->answer_2_image) }}" alt="{{ $question->answer_2_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_2_text }}</p>
                    </li>
                    @elseif( $question->correct_answer == 3 )
                    <li>
                        @if( !empty($question->answer_3_image) )
                        <img src="{{ getImage($question->answer_3_image) }}" alt="{{ $question->answer_3_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_3_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_3_text }}</p>
                    </li>
                    @elseif( $question->correct_answer == 4 )
                    <li>
                        @if( !empty($question->answer_4_image) )
                        <img src="{{ getImage($question->answer_4_image) }}" alt="{{ $question->answer_4_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_4_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_4_text }}</p>
                    </li>
                    @elseif( $question->correct_answer == 5 )
                    <li>
                        @if( !empty($question->answer_5_image) )
                        <img src="{{ getImage($question->answer_5_image) }}" alt="{{ $question->answer_5_text }}"
                            width="150px">
                        @else
                        <img src="/images/choice-no-image.jpg" alt="{{ $question->answer_5_text }}" width="150px">
                        @endif
                        <p>{{ $question->answer_5_text }}</p>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<div class="card card-default">
    <div class="card-body">
        <h4>No questions found! Pleaes add questions...</h4>
    </div>
</div>

@endif
<!-- form start -->
<form method="POST" action="/admin/questions" enctype="multipart/form-data" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add New Question</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" name="question" class="form-control" id="question"
                                    placeholder="Type quiz question" value="{{ old('question') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correct_answer">Correct Answer</label>
                                <select name="correct_answer" class="form-control" id="correct_answer"
                                    placeholder="Select correct answer">
                                    <option value="1">Answer 1</option>
                                    <option value="2">Answer 2</option>
                                    <option value="3">Answer 3</option>
                                    <option value="4">Answer 4</option>
                                    <option value="5">Answer 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="answer_1_text">Answer 1</label>
                                <input type="text" name="answer_1_text" class="form-control" id="answer_1_text"
                                    placeholder="Type answer 1" value="{{ old('answer_1_text') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer_1_image">Answer 1 Image</label>
                                <input type="hidden" name="types[]" value="image">
                                <div class="qp-image-drop rounded">
                                    <!-- choose media -->
                                    <div class="qp-featured-image show-selected-files">
                                        <div class="show-image-preview" data-toggle="offcanvas"
                                            data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                            data-selection="single">
                                            <input type="hidden" name="answer_1_image"
                                                value="{{ old('answer_1_image') }}">
                                            <div class="qp-icon-btn qp-green rounded-circle">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="answer_2_text">Answer 2</label>
                                <input type="text" name="answer_2_text" class="form-control" id="answer_2_text"
                                    placeholder="Type answer 2" value="{{ old('answer_2_text') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer_2_image">Answer 2 Image</label>
                                <input type="hidden" name="types[]" value="image">
                                <div class="qp-image-drop rounded">
                                    <!-- choose media -->
                                    <div class="qp-featured-image show-selected-files">
                                        <div class="show-image-preview" data-toggle="offcanvas"
                                            data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                            data-selection="single">
                                            <input type="hidden" name="answer_2_image"
                                                value="{{ old('answer_2_image') }}">
                                            <div class="qp-icon-btn qp-green rounded-circle">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="answer_3_text">Answer 3</label>
                                <input type="text" name="answer_3_text" class="form-control" id="answer_3_text"
                                    placeholder="Type answer 3" value="{{ old('answer_3_text') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer_3_image">Answer 3 Image</label>
                                <input type="hidden" name="types[]" value="image">
                                <div class="qp-image-drop rounded">
                                    <!-- choose media -->
                                    <div class="qp-featured-image show-selected-files">
                                        <div class="show-image-preview" data-toggle="offcanvas"
                                            data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                            data-selection="single">
                                            <input type="hidden" name="answer_3_image"
                                                value="{{ old('answer_3_image') }}">
                                            <div class="qp-icon-btn qp-green rounded-circle">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-3">
                            @if( $quiz->no_of_choices > 3 )
                            <div class="form-group">
                                <label for="answer_4_text">Answer 4</label>
                                <input type="text" name="answer_4_text" class="form-control" id="answer_4_text"
                                    placeholder="Type answer 4" value="{{ old('answer_4_text') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer_4_image">Answer 4 Image</label>
                                <input type="hidden" name="types[]" value="image">
                                <div class="qp-image-drop rounded">
                                    <!-- choose media -->
                                    <div class="qp-featured-image show-selected-files">
                                        <div class="show-image-preview" data-toggle="offcanvas"
                                            data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                            data-selection="single">
                                            <input type="hidden" name="answer_4_image"
                                                value="{{ old('answer_4_image') }}">
                                            <div class="qp-icon-btn qp-green rounded-circle">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>
                            @endif
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-md-3">
                            @if( $quiz->no_of_choices > 4 )
                            <div class="form-group">
                                <label for="answer_5_text">Answer 5</label>
                                <input type="text" name="answer_5_text" class="form-control" id="answer_5_text"
                                    placeholder="Type answer 5" value="{{ old('answer_5_text') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer_5_image">Answer 5 Image</label>
                                <input type="hidden" name="types[]" value="image">
                                <div class="qp-image-drop rounded">
                                    <!-- choose media -->
                                    <div class="qp-featured-image show-selected-files">
                                        <div class="show-image-preview" data-toggle="offcanvas"
                                            data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                            data-selection="single">
                                            <input type="hidden" name="answer_5_image"
                                                value="{{ old('answer_5_image') }}">
                                            <div class="qp-icon-btn qp-green rounded-circle">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>
                            @endif
                        </div> <!-- /.col -->
                        <div class="col-md-9">
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
    <div class="card card-default">
        <div class="card-body">
            <button type="submit" name="addQuestion" class="btn btn-primary" id="addQuestion">Add Question</button>
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
</form>

@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Summernote', true)
@section('plugins.BootstrapSwitch', true)
@section('adminlte_js')
<script>
    // runs when the document is ready --> for media files
    $(document).ready(function() {
        getChosenFilesCount();
        showSelectedFilePreviewOnLoad();
    
        // Show/Hide Quiz Type
        var quizType = $('#type').find(":selected").val();
        if( quizType == 'trivia' ) {
            $('#blockResults').hide();            
        }
        else {
            var noOfChoices = $('#no_of_choices').find(":selected").val();
            if( noOfChoices < 4 ) { 
                $('#quiz_result_4').hide(); 
                $('#quiz_result_5').hide(); 
            } 
            if( noOfChoices < 5 ) {
                $('#quiz_result_5').hide(); 
            }
        }

        $('#type').on('change', function() {
            var quizType = this.value;
        
            if( quizType == 'trivia' ) {
                $('#blockResults').slideUp();
            }
            else if( quizType == 'personality' ) {
                $('#blockResults').slideDown();

                var noOfChoices = $('#no_of_choices').find(":selected").val();
                if( noOfChoices < 4 ) {
                    $('#quiz_result_4').hide();
                    $('#quiz_result_5').hide();
                }
                if( noOfChoices < 5 ) {
                    $('#quiz_result_5').hide();
                }
            }
        });

        // Show/Hide Quiz Results
        $('#no_of_choices').on('change', function() {
            var noOfChoices = $('#no_of_choices').find(":selected").val();
            var quizType = $('#type').find(":selected").val();
            if( quizType == 'personality' ) {
                if( noOfChoices == 3 ) {
                    $('#quiz_result_4').slideUp();
                    $('#quiz_result_5').slideUp();
                }                
                if( noOfChoices == 4 ) {
                    $('#quiz_result_4').slideDown();
                    $('#quiz_result_5').slideUp();
                }
                if( noOfChoices == 5 ) {
                    $('#quiz_result_4').slideDown();
                    $('#quiz_result_5').slideDown();
                }
            }
        });
    });
  $(function () {
    $('#description').summernote({
      height: 100, // set editor height
    })

    $("[name='is_featured']").bootstrapSwitch(false);
});
</script>
@stop