@extends('adminlte::page')

@section('title', 'Edit Page')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Edit Page</h1>
  </div> <!-- /.col -->
  <div class="col-6">
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/pages/{{$page->id}}" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
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
              value="{{ $page->title }}">
          </div>
          <div class="form-group">
            <label for="content">Page Content</label>
            <textarea name="content" id="content" rows="10">{{ $page->content }}</textarea>
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
              value="{{ $page->meta_title }}">
          </div>

          <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control" id="meta_description"
              placeholder="Type meta description">{{ $page->meta_description }}</textarea>
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
          @include('backend.components.media-input', ['value' => 'featured_image', 'image' => $page->featured_image])
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" placeholder="Select page status">
              <option value="draft" {{ $page->status == 'draft' ? 'selected="selected"' : '' }}>Draft</option>
              <option value="published" {{ $page->status == 'published' ? 'selected="selected"' : '' }}>Published
              </option>
            </select>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->

      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <button type="submit" name="updatePage" class="btn btn-flat btn-primary" id="updatePage"><i
                class="far fa-save"></i> {{ $page->status == 'draft' ? 'Save Draft' : 'Publish Page' }}</button>
            <a class="btn btn-flat btn-secondary float-right" href="/admin/pages"><i class="fas fa-share"></i> Back</a>
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

    $("[name='is_featured']").bootstrapSwitch(false);

    $('#status').on('change', function() {        
      var status = this.value;        
      if( status == 'published' ) {          
        $('#updatePage').html('<i class="far fa-save"></i> Publish Page');
      }
      else if( status == 'draft' ) {
        $('#updatePage').html('<i class="far fa-save"></i> Save Draft');
      }
    });

});
</script>
@stop