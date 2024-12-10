@extends('adminlte::page')

@section('title', 'Cron Job Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Cron Job Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Cron Job Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Setup Cron Job</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <strong>Name:</strong><br>
            Subscription Auto Active and Expire
          </div> <!-- /.col -->
          <div class="col-md-3">
            <strong>Command:</strong><br>
            <code>artisan subscription:expire</code>
          </div> <!-- /.col -->
          <div class="col-md-6">
            <strong>Example:</strong><br>
            <span class="text-sm">cd /home/plrmikbn/fusionlabai.com/ && php artisan subscription:expire >> /dev/null
              2>&1</span>
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
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