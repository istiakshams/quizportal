@extends('adminlte::page')

@section('title', 'Add New Page')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Add New Page</h1>
  </div> <!-- /.col -->
  <div class="col-6">
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/pages" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Page Details</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="title">Page Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Type page title"
              value="{{ old('title') }}">
          </div>
          <div class="form-group">
            <label for="content">Page Content</label>
            <textarea name="content" id="content" rows="10">{{ old('content') }}</textarea>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <!-- SEO Settings -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">SEO Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Type meta title"
              value="{{ old('meta_title') }}">
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
          <h3 class="card-title">Featured Image</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <input type="hidden" name="types[]" value="featured_image">
            <div class="qp-image-drop rounded">
              <!-- choose media -->
              <div class="qp-featured-image show-selected-files">
                <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                  onclick="showMediaManager(this)" data-selection="single">
                  <input type="hidden" name="featured_image" value="{{ old('featured_image') }}">
                  @if( old('featured_image') == null )
                  <div class="qp-icon-btn qp-green rounded-circle">
                    <i class="fas fa-plus"></i>
                  </div>
                  @else
                  <div class="qp-icon-btn qp-green rounded-circle">
                    <i class="fas fa-upload"></i>
                  </div>
                  @endif
                </div>
              </div>
              <!-- choose media -->
            </div>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" placeholder="Select page status">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
            </select>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->

      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <button type="submit" name="savePage" class="btn btn-primary" id="savePage">Save Page</button>
            <a class="btn btn-secondary float-right" href="/admin/pages">Back</a>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
</form>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Select2', true)
@section('plugins.Summernote', true)
@section('plugins.BootstrapSwitch', true)
@section('adminlte_js')
<script>
  // runs when the document is ready --> for media files
    $(document).ready(function() {
    getChosenFilesCount();
    showSelectedFilePreviewOnLoad();
  });
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#content').summernote({
      height: 300, // set editor height
    })

    // $("input[data-bootstrap-switch]").each(function(){
    //   $(this).bootstrapSwitch('state', 'false');
    // })
    $("[name='is_featured']").bootstrapSwitch(false);
});
</script>
@stop