@extends('adminlte::page')

@section('title', 'Utilities')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Utilities</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-4">
    <div class="card card-default">
      <div class="card-body">
        <!-- form start -->
        <form method="POST" action="{{ route('admin.clearCache') }}" id="clearCacheForm" role="form">
          {{ csrf_field() }}
          <div class="form-group text-center">
            <h3>Clear System Cache</h3><br>
            <button type="submit" name="clearCache" class="btn btn-flat btn-primary" id="clearCache">Clear
              Cache</button>
          </div>
        </form>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
  <div class="col-4">
    <div class="card card-default">
      <div class="card-body">
        <!-- form start -->
        <form method="POST" action="{{ route('admin.optimize') }}" id="optimizeForm" role="form">
          {{ csrf_field() }}
          <div class="form-group text-center">
            <h3>Optimize System</h3><br>
            <button type="submit" name="optimize" class="btn btn-flat btn-primary" id="optimize">Optimize</button>
          </div>
        </form>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
  <div class="col-4">
    <div class="card card-default">
      <div class="card-body">
        <!-- form start -->
        <form method="POST" action="{{ route('admin.clearLog') }}" id="clearLogForm" role="form">
          {{ csrf_field() }}
          <div class="form-group text-center">
            <h3>Clear System Log</h3><br>
            <button type="submit" name="clearLog" class="btn btn-flat btn-primary" id="clearLog">Clear Log</button>
          </div>
        </form>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop
@section('plugins.jQuery-UI', true)
@section('adminlte_js')
<script>
  $(function () {
    $("#clearCacheForm").on("submit", function () {
      $('#clearCache').prop('disabled', true);
      $('#clearCache').html('Clearing Cache...');
    });
    $("#optimizeForm").on("submit", function () {        
      $('#optimize').prop('disabled', true);        
      $('#optimize').html('Optimizing System...');        
    });        
    $("#clearLogForm").on("submit", function () {            
      $('#clearLog').prop('disabled', true);            
      $('#clearLog').html('Clearing System Log...');            
    });
    
  });
</script>
@stop