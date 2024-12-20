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
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Site Logo</h3>
    </div> <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          @include('backend.components.media-input', ['label' => 'Site Logo Light', 'value' => 'site_logo_light',
          'image' => getThemeSetting('site_logo_light')])
        </div> <!-- /.col -->
        <div class=" col-md-6">
          @include('backend.components.media-input', ['label' => 'Site Logo Dark', 'value' => 'site_logo_dark',
          'image' => getThemeSetting('site_logo_dark')])
        </div> <!-- /.col -->
      </div> <!-- /.row -->
    </div> <!-- /.card-body -->
  </div> <!-- /.card -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <button type="submit" name="saveHeaderSettings" class="btn btn-flat btn-primary"
            id="saveHeaderSettings">Save</button>
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