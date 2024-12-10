@extends('adminlte::page')

@section('title', 'Storage Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Storage Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Storage Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/settings/storage-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Active Storage</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="active_storage">Active Storage</label>
                <select name="active_storage" class="form-control" id="active_storage">
                  <option value="local" {{ getSetting('active_storage')=='local' ? 'selected' : '' }}>Local</option>
                  <option value="s3" {{ getSetting('active_storage')=='s3' ? 'selected' : '' }}>Amazon</option>
                </select>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div id="AWS_Details">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Amazon Storage Settings</h3>
          </div> <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aws_access_key">AWS Access Key</label>
                  <input type="text" name="aws_access_key" class="form-control" id="aws_access_key"
                    placeholder="Enter AWS Access Key" value="{{ getSetting('aws_access_key') }}">
                </div>
              </div> <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aws_secret_key">AWS Secret Access Key</label>
                  <input type="text" name="aws_secret_key" class="form-control" id="aws_secret_key"
                    placeholder="Enter AWS Secret Access Key" value="{{ getSetting('aws_secret_key') }}">
                </div>
              </div> <!-- /.col -->
            </div> <!-- /.row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aws_s3_bucket_name">AWS S3 Bucket Name</label>
                  <input type="text" name="aws_s3_bucket_name" class="form-control" id="aws_s3_bucket_name"
                    placeholder="Enter AWS S3 Bucket Name" value="{{ getSetting('aws_s3_bucket_name') }}">
                </div>
              </div> <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aws_region">AWS Region</label>
                  <input type="text" name="aws_region" class="form-control" id="aws_region"
                    placeholder="Enter AWS Region" value="{{ getSetting('aws_region') }}">
                </div>
              </div> <!-- /.col -->
            </div> <!-- /.row -->
          </div> <!-- /.card-body -->
        </div> <!-- /.card -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </div> <!-- /.AWS_Details -->

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <button type="submit" name="saveStorageSettings" class="btn btn-flat btn-primary"
            id="saveStorageSettings">Save</button>
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
    $(document).ready(function() {
      var active_storage = $('#active_storage').find(":selected").val();
      if( active_storage == 'local' ) {
        $('#AWS_Details').hide();
      }
    });
  
  $(function () {
    $('#active_storage').on('change', function() {
      var active_storage = this.value;
      console.log(active_storage);
      
      if( active_storage == 'local' ) {
        $('#AWS_Details').slideUp();
      }
      else if( active_storage == 's3' ) {
        $('#AWS_Details').slideDown();
      }
    });
  });
});
</script>
@stop