@extends('adminlte::page')

@section('title', 'Module Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Module Settings</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="{{ route('admin.modules.update') }}" role="form">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-4">
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <h3>Subscription & Payment</h3>
            <p>Subscription & Payment system.</p><br>
            <input type="checkbox" name="module_subscription" data-bootstrap-switch data-on-text="Active"
              data-off-text="Inactive" {{ $module_subscription=='1' ? 'checked' : '' }}>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-4">
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <h3>Newsletter</h3>
            <p>Newsletter system.</p><br>
            <input type="checkbox" name="module_newsletter" data-bootstrap-switch data-on-text="Active"
              data-off-text="Inactive" {{ $module_newsletter=='1' ? 'checked' : '' }}>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-4">
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <h3>Support</h3>
            <p>Support system.</p><br>
            <input type="checkbox" name="module_support" data-bootstrap-switch data-on-text="Active"
              data-off-text="Inactive" {{ $module_support=='1' ? 'checked' : '' }}>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
  <div class="row">
    <div class="col-4">
      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <h3>Affiliate</h3>
            <p>Affiliate system.</p><br>
            <input type="checkbox" name="module_affiliate" data-bootstrap-switch data-on-text="Active"
              data-off-text="Inactive" {{ $module_affiliate=='1' ? 'checked' : '' }}>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-4">
    </div> <!-- /.col -->
    <div class="col-4">
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="card card-default">
    <div class="card-body">
      <button type="submit" name="updateModuleSettings" class="btn btn-primary btn-flat"
        id="updateModuleSettings">Update</button>
    </div> <!-- /.card-body -->
  </div> <!-- /.card -->
</form>
@stop

@section('plugins.BootstrapSwitch', true)
@section('adminlte_js')
<script>
  $(function () {
    $("[name='module_subscription']").bootstrapSwitch();
    $("[name='module_newsletter']").bootstrapSwitch();
    $("[name='module_support']").bootstrapSwitch();
    $("[name='module_affiliate']").bootstrapSwitch();
});
</script>
@stop