@extends('adminlte::page')

@section('title', 'Add New Quiz')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Add New Quiz</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/quizzes">Quizzes</a> / Add New Quiz</p>
    </div> <!-- /.col -->
    <div class="col-6">
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/quizzes" enctype="multipart/form-data" role="form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Quiz Details</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Quiz Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Type quiz title"
                            value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description">{{ old('description') }}</textarea>
                    </div>
                    {{-- Quiz Type --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Quiz Type</label>
                                <select name="type" class="form-control" id="type" placeholder="Select quiz type">
                                    <option value="trivia" {{ old('type')=='trivia' ? 'selected="selected"' : '' }}>
                                        Trivia</option>
                                    <option value="personality" {{ old('type')=='personality' ? 'selected="selected"'
                                        : '' }}>Personality
                                    </option>
                                </select>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_of_choices">Number of Choices</label>
                                <select name="no_of_choices" class="form-control" id="no_of_choices"
                                    placeholder="Select number of choices">
                                    <option value="3" {{ old('no_of_choices')==3 ? 'selected="selected"' : '' }}>3
                                    </option>
                                    <option value="4" {{ old('no_of_choices')==4 ? 'selected="selected"' : '' }}>4
                                    </option>
                                    <option value="5" {{ old('no_of_choices')==5 ? 'selected="selected"' : '' }}>5
                                    </option>
                                </select>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                    <div id="blockResults">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_1">Result 1</label>
                                    <input type="text" name="result_1" class="form-control" id="result_1"
                                        placeholder="Type quiz result 1" value="{{ old('result_1') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_1_image">Result 1 Image</label>
                                    <input type="hidden" name="types[]" value="image">
                                    <div class="qp-image-drop rounded">
                                        <!-- choose media -->
                                        <div class="qp-featured-image show-selected-files">
                                            <div class="show-image-preview" data-toggle="offcanvas"
                                                data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                                data-selection="single">
                                                <input type="hidden" name="result_1_image"
                                                    value="{{ old('result_1_image') }}">
                                                <div class="qp-icon-btn qp-green rounded-circle">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_2">Result 2</label>
                                    <input type="text" name="result_2" class="form-control" id="result_2"
                                        placeholder="Type quiz result 2" value="{{ old('result_2') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_2_image">Result 2 Image</label>
                                    <input type="hidden" name="types[]" value="image">
                                    <div class="qp-image-drop rounded">
                                        <!-- choose media -->
                                        <div class="qp-featured-image show-selected-files">
                                            <div class="show-image-preview" data-toggle="offcanvas"
                                                data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                                data-selection="single">
                                                <input type="hidden" name="result_2_image"
                                                    value="{{ old('result_2_image') }}">
                                                <div class="qp-icon-btn qp-green rounded-circle">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_3">Result 3</label>
                                    <input type="text" name="result_3" class="form-control" id="result_3"
                                        placeholder="Type quiz result 3" value="{{ old('result_3') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_3_image">Result 3 Image</label>
                                    <input type="hidden" name="types[]" value="image">
                                    <div class="qp-image-drop rounded">
                                        <!-- choose media -->
                                        <div class="qp-featured-image show-selected-files">
                                            <div class="show-image-preview" data-toggle="offcanvas"
                                                data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                                data-selection="single">
                                                <input type="hidden" name="result_3_image"
                                                    value="{{ old('result_3_image') }}">
                                                <div class="qp-icon-btn qp-green rounded-circle">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="quiz_result_4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_4">Result 4</label>
                                    <input type="text" name="result_4" class="form-control" id="result_4"
                                        placeholder="Type quiz result 4" value="{{ old('result_4') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_4_image">Result 4 Image</label>
                                    <input type="hidden" name="types[]" value="image">
                                    <div class="qp-image-drop rounded">
                                        <!-- choose media -->
                                        <div class="qp-featured-image show-selected-files">
                                            <div class="show-image-preview" data-toggle="offcanvas"
                                                data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                                data-selection="single">
                                                <input type="hidden" name="result_4_image"
                                                    value="{{ old('result_4_image') }}">
                                                <div class="qp-icon-btn qp-green rounded-circle">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="quiz_result_5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_5">Result 5</label>
                                    <input type="text" name="result_5" class="form-control" id="result_5"
                                        placeholder="Type quiz result 5" value="{{ old('result_5') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_5_image">Result 5 Image</label>
                                    <input type="hidden" name="types[]" value="image">
                                    <div class="qp-image-drop rounded">
                                        <!-- choose media -->
                                        <div class="qp-featured-image show-selected-files">
                                            <div class="show-image-preview" data-toggle="offcanvas"
                                                data-target="#offcanvasBottom" onclick="showMediaManager(this)"
                                                data-selection="single">
                                                <input type="hidden" name="result_5_image"
                                                    value="{{ old('result_5_image') }}">
                                                <div class="qp-icon-btn qp-green rounded-circle">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
            <!-- SEO Settings -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Quiz SEO Settings</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title"
                            placeholder="Type meta title" value="{{ old('meta_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" class="form-control" id="meta_description"
                            placeholder="Type meta description">{{ old('meta_description') }}</textarea>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Quiz Image</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="image">
                        <div class="qp-image-drop rounded">
                            <!-- choose media -->
                            <div class="qp-featured-image show-selected-files">
                                <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                                    onclick="showMediaManager(this)" data-selection="single">
                                    <input type="hidden" name="image" value="{{ old('image') }}">
                                    <div class="qp-icon-btn qp-green rounded-circle">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- choose media -->
                        </div>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Quiz Settings</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="categories">Category</label>
                        <div class="form-group">
                            <select name="category_id" class="form-control" id="categories"
                                placeholder="Select category">
                                @foreach( $categories as $categroy )
                                <option value=" {{ $categroy->id }}">{{ $categroy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <div class="form-group">
                            <select name="author_id" class="form-control" id="author_id" placeholder="Select an author">
                                @foreach( $users as $user )
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_featured">Featured</label>
                        <div class="form-group">
                            <input type="checkbox" name="is_featured" data-bootstrap-switch data-on-text="Yes"
                                data-off-text="No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" placeholder="Select blog status">
                            <option value="draft" selected="selected">Draft</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

            <div class="card card-default">
                <div class="card-body">
                    <button type="submit" name="saveQuiz" class="btn btn-primary" id="saveQuiz"><i
                            class="far fa-save"></i> Save Quiz</button>
                    <a class="btn btn-secondary float-right" href="/admin/quizzes"><i class="fas fa-share"></i> Back</a>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
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
                $('#blockResults').slideUp()
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