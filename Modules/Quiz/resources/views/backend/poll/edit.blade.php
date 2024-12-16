@extends('adminlte::page')

@section('title', 'Edit Poll')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Edit Poll</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/polls">Polls</a> / Edit Poll</p>
    </div> <!-- /.col -->
    <div class="col-6">
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/polls/{{ $poll->id }}" enctype="multipart/form-data" role="form">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
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
                            placeholder="Type poll question" value="{{ $poll->question }}" required>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Poll Choices</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div id="divChoices">
                        @foreach( $poll->choices as $choice )
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="choices">Choice {{ $loop->iteration }}</label>
                                    <p style="border:1px solid #ced4da;padding:5px 10px;border-radius:.25rem;">{{
                                        $choice->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="votes">Votes</label>
                                    <p style="border:1px solid #ced4da;padding:5px 10px;border-radius:.25rem;">{{
                                        $choice->votes }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="editChoice">&nbsp;</label>
                                    <a href="javascript:void(0)" data-id="{{ $choice->id }}"
                                        class="btn btn-block btn-flat btn-primary" id="editChoice"><i
                                            class="far fa-edit"></i>
                                        Edit</a>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @if( $loop->iteration > 2 )
                                <label for="deleteChoice">&nbsp;</label>
                                <a href="javascript:void(0)" data-id="{{ $choice->id }}"
                                    class="btn btn-block btn-flat btn-danger" id="showDeleteModal"><i
                                        class="far fa-trash-alt"></i>
                                    Delete</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <a href="javascript:void(0)" data-pollid="{{ $choice->poll_id }}" class=" btn btn-flat
                            btn-primary" id="addChoice"><i class="fas fa-plus"></i> Add New</a>
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
                            placeholder="Type meta title" value="{{ $poll->meta_title }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" class="form-control" id="meta_description"
                            placeholder="Type meta description">{{ $poll->meta_description }}</textarea>
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
                                    <input type="hidden" name="image" value="{{ $poll->image }}">
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
                                data-off-text="No" {{ $poll->maxCheck == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="canVisitorsVote">Can Visitors Vote?</label>
                        <div class="form-group">
                            <input type="checkbox" name="canVisitorsVote" data-bootstrap-switch data-on-text="Yes"
                                data-off-text="No" {{ $poll->canVisitorsVote == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <div class="form-group">
                            <select name="author_id" class="form-control" id="author_id" placeholder="Select an author">
                                @foreach( $users as $user )
                                <option value="{{ $user->id }}" {{ $user->id == $poll->author_id ? 'selected="selected"'
                                    : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" placeholder="Select blog status">
                            <option value="draft" {{ $poll->status == 'draft' ? 'selected="selected"' : '' }}>Draft
                            </option>
                            <option value="published" {{ $poll->status == 'published' ? 'selected="selected"' : ''
                                }}>Published</option>
                            <option value="closed" {{ $poll->status == 'closed' ? 'selected="selected"' : '' }}>Closed
                            </option>
                        </select>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

            <div class="card card-default">
                <div class="card-body">
                    <button type="submit" name="updatePoll" class="btn btn-flat btn-primary" id="updatePoll"><i
                            class="far fa-save"></i> Update Poll</button>
                    <a class="btn btn-flat btn-secondary float-right" href="/admin/polls"><i class="fas fa-share"></i>
                        Back</a>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</form>

@include('quiz::backend.poll.modals.create-modal')
@include('quiz::backend.poll.modals.edit-modal')
@include('quiz::backend.poll.modals.delete-modal')
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


        // Header Token    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Click to Add Button
        $('body').on('click', '#addChoice', function () {
            var poll_id = $(this).data('pollid');
            $('#addChoiceModel').modal('show');
            $('#pollId').val(poll_id);
        });

        // Add Choice
        $('#addChoiceForm').submit(function(e) {
        
            e.preventDefault();        
            $('#saveChoice').html('Saving...');
            $.ajax({
                data: $('#addChoiceForm').serialize(),
                url: "{{ route('admin.pollchoices.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#addChoiceForm').trigger("reset");
                    $('#saveChoice').html('Save');
                    $('#addChoiceModel').modal('hide');

                    // Reload the table
                    $('#divChoices').html(data.choices);
        
                    // Show Toast
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        autohide: true,
                        delay: 2000,
                        title: 'Success',
                        body: data.success
                    });
                },
                error: function (data) {
                    $('#updateChoice').html('Update');
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        autohide: true,
                        delay: 2000,
                        title: 'Error',
                        body: data.responseJSON.error
                    })
                }
            });
        });

        // Click to Edit Button
        $('body').on('click', '#editChoice', function () {
            var id = $(this).data('id');
            
            $.get('/admin/pollchoices/' + id +'/edit', function (data) {
                $('#editChoiceModel').modal('show');
                $('#editId').val(data.id);
                $('#editPollId').val(data.poll_id);                
                $('#editName').val(data.name);
                $('#editVotes').val(data.votes);
            })
        });

        // Update Choice
        $('#editChoiceForm').submit(function(e) {
            e.preventDefault();
            $('#updateChoice').html('Updating...');
            $.ajax({
                data: $('#editChoiceForm').serialize(),
                url: "{{ route('admin.pollchoices.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#editChoiceForm').trigger("reset");
                    $('#updateChoice').html('Update');
                    $('#editChoiceModel').modal('hide');

                    // Update choice div
                    $('#divChoices').html(data.choices);

                    // Show Toast
                    $(document).Toasts('create', {        
                        class: 'bg-success',
                        autohide: true,
                        delay: 2000,
                        title: 'Success',
                        body: data.success
                    });        
                },        
                error: function (data) {
                    $('#updateChoice').html('Update');
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        autohide: true,
                        delay: 2000,
                        title: 'Error',
                        body: data.responseJSON.error
                    })
                }
            });
        });


        // Delete Button Click                
        $('body').on('click', '#showDeleteModal', function () {
            var id = $(this).data('id');
            $('#deleteChoiceModal').modal('show');
            $('#deleteId').val(id);
        })

        // Delete Choice
        $('#deleteChoiceForm').submit(function(e) {
            e.preventDefault();
            var id = $("#deleteId").val();
            $.ajax({
                type: "DELETE",
                url: '/admin/pollchoices/'+id,
                success: function (data) {
                    $('#deleteChoiceModal').modal('hide');

                    // Update choice div
                    $('#divChoices').html(data.choices);
        
                    // Show Toast
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        autohide: true,
                        delay: 2000,
                        title: 'Success',
                        body: data.success
                    });
                },
                error: function (data) {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        autohide: true,
                        delay: 2000,
                        title: 'Error',
                        body: data.responseJSON.error
                    })
                }
            });
        });    
    });
</script>
@stop