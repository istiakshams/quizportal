@extends('adminlte::page')

@section('title', 'Header Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Header Settings</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/appearance/header-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Site Logo</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="site_logo_light">Site Logo Light</label>
            <input type="hidden" name="types[]" value="site_logo_light">
            <div class="qp-image-drop rounded">
              <span class="fw-semibold">Choose Light Logo</span>
              <!-- choose media -->
              <div class="qp-logo-image show-selected-files mt-3">
                <div class="qp-avatar qp-avatar-xl cursor-pointer choose-media" data-toggle="offcanvas"
                  data-target="#offcanvasBottom" onclick="showMediaManager(this)" data-selection="single">
                  <input type="hidden" name="site_logo_light" value="{{ getThemeSetting('site_logo_light') }}">
                  <div class="qp-no-avatar rounded-circle">
                    <span><i class="fas fa-plus"></i></span>
                  </div>
                </div>
              </div>
              <!-- choose media -->
            </div>
          </div>
          <div class="form-group">
            <label for="site_logo_dark">Site Logo Dark</label>
            <input type="hidden" name="types[]" value="site_logo_dark">
            <div class="qp-image-drop rounded">
              <span class="fw-semibold">Choose Dark Logo</span>
              <!-- choose media -->
              <div class="qp-logo-image show-selected-files mt-3">
                <div class="qp-avatar qp-avatar-xl cursor-pointer choose-media" data-toggle="offcanvas"
                  data-target="#offcanvasBottom" onclick="showMediaManager(this)" data-selection="single">
                  <input type="hidden" name="site_logo_dark" value="{{ getThemeSetting('site_logo_dark') }}">
                  <div class="qp-no-avatar rounded-circle">
                    <span><i class="fas fa-plus"></i></span>
                  </div>
                </div>
              </div>
              <!-- choose media -->
            </div>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class=" col-md-6">

    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <button type="submit" name="saveHeaderSettings" class="btn btn-primary"
              id="saveHeaderSettings">Save</button>
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
    //     
  });
</script>
@stop