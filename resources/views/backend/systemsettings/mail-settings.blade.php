@extends('adminlte::page')

@section('title', 'Mail Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Mail Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Mail Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/settings/mail-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Mail Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="mail_type">Mail Type</label>
                <select name="mail_type" class="form-control" id="mail_type">
                  <option value="smtp" {{ getSetting('mail_type')=='smtp' ? 'selected' : '' }}>SMTP</option>
                  <option value="sendmail" {{ getSetting('mail_type')=='sendmail' ? 'selected' : '' }}>PHP SendMail
                  </option>
                </select>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
          <div id="SMTP_Details">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="smtp_host">SMTP Host</label>
                  <input type="text" name="smtp_host" class="form-control" id="smtp_host" placeholder="Enter SMTP Host"
                    maxlength="256" value="{{ getSetting('smtp_host') }}">
                </div>
              </div> <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="smtp_port">SMTP Port</label>
                  <input type="text" name="smtp_port" class="form-control" id="smtp_port" placeholder="Enter SMTP Port"
                    maxlength="5" value="{{ getSetting('smtp_port') }}">
                </div>
              </div> <!-- /.col -->
            </div> <!-- /.row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="mail_username">Mail Username</label>
                  <input type="text" name="mail_username" class="form-control" id="mail_username" maxlength="256"
                    placeholder="Enter Mail Username" value="{{ getSetting('mail_username') }}">
                </div>
              </div> <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="mail_password">Mail Password</label>
                  <input type="text" name="mail_password" class="form-control" id="mail_password" maxlength="256"
                    placeholder="Enter Mail Password" value="{{ getSetting('mail_password') }}">
                </div>
              </div> <!-- /.col -->
            </div> <!-- /.row -->
          </div> <!-- /.SMTP_Details -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="mail_from_address">Mail From Address</label>
                <input type="text" name="mail_from_address" class="form-control" id="mail_from_address" maxlength="256"
                  placeholder="Enter From Address" value="{{ getSetting('mail_from_address') }}" required>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="mail_from_name">Mail From Name</label>
                <input type="text" name="mail_from_name" class="form-control" id="mail_from_name" maxlength="256"
                  placeholder="Enter Mail From Name" value="{{ getSetting('mail_from_name') }}" required>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
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
          <button type="submit" name="saveMailSettings" class="btn btn-flat btn-primary"
            id="saveMailSettings">Save</button>
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
  $(document).ready(function() {
    var mail_type = $('#mail_type').find(":selected").val();
    if( mail_type == 'sendmail' ) {
      $('#SMTP_Details').hide();
    }
  });

  $(function () {
    $('#mail_type').on('change', function() {
      var mail_type = this.value;

      if( mail_type == 'sendmail' ) {
        $('#SMTP_Details').slideUp();
      }
      else if( mail_type == 'smtp' ) {
        $('#SMTP_Details').slideDown();
      }
    });    
  });
</script>
@stop