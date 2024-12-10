@extends('adminlte::page')

@section('title', 'Subscription Report')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Subscription Report</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')



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