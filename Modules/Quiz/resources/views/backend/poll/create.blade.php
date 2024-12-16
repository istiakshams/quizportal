@extends('adminlte::page')

@section('title', 'Add New Poll')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Add New Poll</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/polls">Polls</a> / Add New Poll</p>
    </div> <!-- /.col -->
    <div class="col-6">
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/polls" enctype="multipart/form-data" role="form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Poll Details</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="question">Poll Question</label>
                        <input type="text" name="question" class="form-control" id="question"
                            placeholder="Type poll question" value="{{ old('question') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="choices">Choice 1</label>
                        <input type="text" name="choices[]" class="form-control" id="choice_1"
                            placeholder="Type choice 1" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="choices">Choice 2</label>
                        <input type="text" name="choices[]" class="form-control" id="choice_2"
                            placeholder="Type choice 2" value="" required>
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
                    <h3 class="card-title">Poll Image</h3>
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
                    <h3 class="card-title">Poll Settings</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="maxCheck">Enable Multiple Choices?</label>
                        <div class="form-group">
                            <input type="checkbox" name="maxCheck" data-bootstrap-switch data-on-text="Yes"
                                data-off-text="No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="canVisitorsVote">Can Visitors Vote?</label>
                        <div class="form-group">
                            <input type="checkbox" name="canVisitorsVote" data-bootstrap-switch data-on-text="Yes"
                                data-off-text="No">
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
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" placeholder="Select blog status">
                            <option value="draft" selected="selected">Draft</option>
                            <option value="published">Published</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

            <div class="card card-default">
                <div class="card-body">
                    <button type="submit" name="savePoll" class="btn btn-primary" id="savePoll"><i
                            class="far fa-save"></i> Save Poll</button>
                    <a class="btn btn-secondary float-right" href="/admin/polls"><i class="fas fa-share"></i> Back</a>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</form>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.BootstrapSwitch', true)
@section('adminlte_js')
<script>
    // runs when the document is ready --> for media files
    $(document).ready(function() {    
        getChosenFilesCount();    
        showSelectedFilePreviewOnLoad();

        

        $(function () {
            $("[name='maxCheck']").bootstrapSwitch(false);
            $("[name='canVisitorsVote']").bootstrapSwitch(false);
        });
    });
</script>
@stop