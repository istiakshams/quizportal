@extends('adminlte::page')

@section('title', 'Auth Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Auth Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Auth Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/settings/auth-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Login & Registration</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="customer_registration">Customer Registration</label>
            <select name="customer_registration" class="form-control" id="customer_registration">
              <option value="email_only" {{ getSetting('customer_registration')=='email_only' ? 'selected' : '' }}>Email
                Required</option>
              <option value="email_and_phone" {{ getSetting('customer_registration')=='email_and_phone' ? 'selected'
                : '' }}>
                Email
                and Phone Required</option>
            </select>
          </div>
          <div class="form-group">
            <label for="registration_verification">Registration Verification</label>
            <select name="registration_verification" class="form-control" id="registration_verification">
              <option value="disabled" {{ getSetting('registration_verification')=='disabled' ? 'selected' : '' }}>
                Disabled</option>
              <option value="email_verification" {{ getSetting('registration_verification')=='email_verification'
                ? 'selected' : '' }}>
                Email Verification</option>
              <option value="otp_verification" {{ getSetting('registration_verification')=='otp_verification'
                ? 'selected' : '' }}>OTP
                Verification</option>
            </select>
          </div>
          <div class="form-group">
            <label for="welcome_email">Send Welcome Email After Registration</label>
            <div class="form-group">
              <input type="checkbox" name="welcome_email" data-bootstrap-switch {{ getSetting('welcome_email')=='1'
                ? 'checked' : '' }}>
            </div>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-md-6">

    </div> <!-- /.col -->
  </div> <!-- /.row -->


  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">OTP Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="twilio_sid">Twilio SID</label>
            <input type="text" name="twilio_sid" class="form-control" id="twilio_sid" placeholder="Enter Twilio SID"
              value="{{ getSetting('twilio_sid') }}">
          </div>
          <div class="form-group">
            <label for="twilio_auth_token">Twilio Auth Token</label>
            <input type="text" name="twilio_auth_token" class="form-control" id="twilio_auth_token"
              placeholder="Enter Twilio Auth Token" value="{{ getSetting('twilio_auth_token') }}">
          </div>
          <div class="form-group">
            <label for="valid_twilo_number">Valid Twilo Number</label>
            <input type="text" name="valid_twilo_number" class="form-control" id="valid_twilo_number"
              placeholder="Enter Valid Twilo Number" value="{{ getSetting('valid_twilo_number') }}">
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-md-6">

    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Google Login</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="welcome_email">Enable Google Login</label>
            <div class="form-group">
              <input type="checkbox" name="enable_google_login" data-bootstrap-switch {{
                getSetting('enable_google_login')=='1' ? 'checked' : '' }}>
            </div>
          </div>
          <div class="form-group">
            <label for="customer_registration">Google Client ID</label>
            <input type="text" name="google_client_id" class="form-control" id="google_client_id"
              placeholder="Enter Google Client ID" value="{{ getSetting('google_client_id') }}">
          </div>
          <div class="form-group">
            <label for="registration_verification">Google Client Secret</label>
            <input type="text" name="google_client_secret" class="form-control" id="google_client_secret"
              placeholder="Enter Google Client Secret" value="{{ getSetting('google_client_secret') }}">
          </div>
          <div class="form-group">
            <label for="google_redirect_url">Google Redirect Url</label>
            <input type="text" name="google_redirect_url" class="form-control" id="google_redirect_url"
              value="https://fusionlabai.com/social-login/redirect/google" disabled>
          </div>
          <div class="form-group">
            <label for="google_callback_url">Google Callback Url</label>
            <input type="text" name="google_callback_url" class="form-control" id="google_callback_url"
              value="https://fusionlabai.com/social-login/google/callback" disabled>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->

    <div class="col-md-6">

    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Facebook Login</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="enable_facebook_login">Enable Facebook Login</label>
            <div class="form-group">
              <input type="checkbox" name="enable_facebook_login" data-bootstrap-switch {{
                getSetting('enable_facebook_login')=='1' ? 'checked' : '' }}>
            </div>
          </div>
          <div class="form-group">
            <label for="faceboo_app_id">Facebook App ID</label>
            <input type="text" name="faceboo_app_id" class="form-control" id="faceboo_app_id"
              placeholder="Enter Facebook App ID" value="{{ getSetting('faceboo_app_id') }}">
          </div>
          <div class="form-group">
            <label for="faceboo_app_secret">Facebook App Secret</label>
            <input type="text" name="faceboo_app_secret" class="form-control" id="faceboo_app_secret"
              placeholder="Enter Facebook App Secret" value="{{ getSetting('faceboo_app_secret') }}">
          </div>
          <div class="form-group">
            <label for="facebook_redirect_url">Facebook Redirect Url</label>
            <input type="text" name="facebook_redirect_url" class="form-control" id="facebook_redirect_url"
              value="https://fusionlabai.com/social-login/redirect/facebook" disabled>
          </div>
          <div class="form-group">
            <label for="facebook_callback_url">Facebook Callback Url</label>
            <input type="text" name="facebook_callback_url" class="form-control" id="facebook_callback_url"
              value="https://fusionlabai.com/social-login/facebook/callback" disabled>
          </div>
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
          <div class="form-group">
            <button type="submit" name="saveAuthSettings" class="btn btn-primary" id="saveAuthSettings">Save</button>
          </div>
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