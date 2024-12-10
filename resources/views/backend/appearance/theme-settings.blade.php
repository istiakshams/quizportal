@extends('adminlte::page')

@section('title', 'Theme Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Theme Settings</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')



<div class="row">
  <div class="col-md-3">
    <!-- form start -->
    <form method="POST" action="/admin/appearance/theme-settings" enctype="multipart/form-data" role="form">
      {{ csrf_field() }}
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Default Theme</h3>
        </div> <!-- /.card-header -->
        <div class="card-body text-center">
          <img src="{{ asset('/images/themes/default-theme/default-theme.png') }}" alt="Default Theme" />
        </div> <!-- /.card -->
        <div class="card-footer">
          @if( getThemeName() == 'default-theme' )
          <button type="submit" name="setTheme" class="btn btn-secondary" id="setTheme" disabled>Active</button>
          @else
          <input type="hidden" name="theme_name" value="default-theme" />
          <button type="submit" name="setTheme" class="btn btn-primary" id="setTheme">Activate
            Theme</button>
          @endif
        </div> <!-- /.card-footer -->
      </div> <!-- /.card -->
    </form>
  </div> <!-- /.col -->
  <div class="col-md-3">
    <div class="card card-default">
      <!-- form start -->
      <form method="POST" action="/admin/appearance/theme-settings" enctype="multipart/form-data" role="form">
        {{ csrf_field() }}
        <div class="card-header">
          <h3 class="card-title">Modern Theme</h3>
        </div> <!-- /.card-header -->
        <div class="card-body text-center">
          <img src="{{ asset('/images/themes/modern-theme/modern-theme.png') }}" alt="Modern Theme" />
        </div> <!-- /.card -->
        <div class="card-footer">
          @if( getThemeName() == 'modern-theme' )
          <button type="submit" name="setTheme" class="btn btn-secondary" id="setTheme" disabled>Active</button>
          @else
          <input type="hidden" name="theme_name" value="modern-theme" />
          <button type="submit" name="setTheme" class="btn btn-primary" id="setTheme">Activate
            Theme</button>
          @endif

        </div> <!-- /.card-footer -->
    </div> <!-- /.card -->
    </form>
  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Select2', true)
@section('plugins.Summernote', true)
@section('plugins.BootstrapSwitch', true)
@section('adminlte_js')
<script>
  $(function () {
    //Initialize Select2 Elements
    // $('#maintenance_mode').select2();
    // $('#category').select2();


    $('#short_description').summernote({
      height: 100, // set editor height
    })
    $('#cookie_consent_text').summernote({
      height: 100, // set editor height
    })

    // $("input[data-bootstrap-switch]").each(function(){
    //   $(this).bootstrapSwitch('state', 'false');
    // })
    $("[name='welcome_email']").bootstrapSwitch(false);
    $("[name='enable_google_login']").bootstrapSwitch(false);
    $("[name='enable_facebook_login']").bootstrapSwitch(false);
    
});
</script>
@stop