@extends('adminlte::page')

@section('title', 'Add New Blog')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Add New Blog</h1>
  </div> <!-- /.col -->
  <div class="col-6">
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/blogs" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Blog Details</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Type blog title"
              value="{{ old('title') }}">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea name="short_description" id="short_description">{{ old('short_description') }}</textarea>
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
          @include('backend.components.media-input', ['value' => 'featured_image', 'image' => ''])
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <label for="categories">Category</label>
            <div class="form-group">
              <select name="categories[]" class="select2" id="categories" multiple="multiple"
                data-placeholder="Select Blog Categories" style="width: 100%;">
                @foreach( $categories as $categroy )
                <option value="{{ $categroy->id }}">{{ $categroy->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <div class="form-group">
              <select name="author" class="form-control" id="author" placeholder="Select an author">
                @foreach( $users as $user )
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="is_featured">Featured Blog</label>
            <div class="form-group">
              <input type="checkbox" name="is_featured" data-bootstrap-switch>
            </div>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" placeholder="Select blog status">
              <option value="draft" selected="selected">Draft</option>
              <option value="published">Published</option>
            </select>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->

      <div class="card card-default">
        <div class="card-body">
          <button type="submit" name="saveBlog" class="btn btn-flat btn-primary" id="saveBlog"><i
              class="far fa-save"></i> Save Draft</button>
          <a class="btn btn-flat btn-secondary float-right" href="/admin/blogs"><i class="fas fa-share"></i> Back</a>
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

    $('#short_description').summernote({
      height: 100, // set editor height
    })
    $('#description').summernote({
      height: 300, // set editor height
    })

    $("[name='is_featured']").bootstrapSwitch(false);

    $('#status').on('change', function() {            
      var status = this.value;            
      if( status == 'published' ) {            
        $('#saveBlog').html('<i class="far fa-save"></i> Publish Blog');            
      }            
      else if( status == 'draft' ) {            
        $('#saveBlog').html('<i class="far fa-save"></i> Save Draft');            
      }            
    });
});
</script>
@stop