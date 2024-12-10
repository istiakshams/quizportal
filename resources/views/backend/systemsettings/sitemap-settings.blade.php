@extends('adminlte::page')

@section('title', 'Sitemap Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Sitemap Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Sitemap Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/settings/sitemap-settings" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Sitemap Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">


        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-md-6">
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <button type="submit" name="saveSitemapSettings" class="btn btn-flat btn-primary"
            id="saveSitemapSettings">Save</button>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

</form>
@stop
@section('plugins.jQuery-UI', true)
@section('adminlte_js')
<script>
  $(function () {
  // 
  });
</script>
@stop