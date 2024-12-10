@extends('adminlte::page')

@section('title', 'Media Manager')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Media Manager</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row g-4">
  <div class="col-12">
    <div data-type="media-index">
      @include('backend.mediamanager.partials.media-manager-content')
    </div>
  </div>
</div>

@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Dropzone', true)

@section('adminlte_js')
<script>
  $(document).ready(function() {
    getMediaFiles();
  });
</script>
@endsection