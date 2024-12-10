@extends('adminlte::page')

@section('title', 'General Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>General Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      General Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/settings/general-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">General Information</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="system_title">System Title</label>
                <input type="text" name="system_title" class="form-control" id="system_title" maxlength="20"
                  placeholder="Type system title" value="{{ getSetting('system_title') }}" required>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="contact_email">Contact Email</label>
                <input type="text" name="contact_email" class="form-control" id="contact_email" maxlength="256"
                  placeholder="Type system title" value="{{ getSetting('contact_email') }}" required>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" name="contact_phone" class="form-control" id="contact_phone" maxlength="14"
                  placeholder="Type system title" value="{{ getSetting('contact_phone') }}" required>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="tab_separator">Browser Tab Title Separator</label>
                <input type="text" name="tab_separator" class="form-control" id="tab_separator" maxlength="10"
                  placeholder="Type system title" value="{{ getSetting('tab_separator') }}" required>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="enable_preloader">Enable Preloader</label>
                <div class="form-group">
                  <input type="checkbox" name="enable_preloader" data-bootstrap-switch data-on-text="Yes"
                    data-off-text="No" {{ getSetting('enable_preloader')=='1' ? 'checked' : '' }}>
                </div>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Dashboard Logo & Favicon</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dashboard_light_logo">Dashboard Light Logo</label>
                <input type="hidden" name="types[]" value="dashboard_light_logo">
                <div class="qp-image-drop rounded">
                  <span class="fw-semibold">Choose Light Logo</span>
                  <!-- choose media -->
                  <div class="qp-logo-image show-selected-files mt-3">
                    <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                      onclick="showMediaManager(this)" data-selection="single">
                      <input type="hidden" name="dashboard_light_logo" value="{{ getSetting('dashboard_light_logo') }}">
                      <div class="qp-icon-btn qp-green rounded-circle">
                        <i class="fas fa-plus"></i>
                      </div>
                    </div>
                    <!-- choose media -->
                  </div>
                </div>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="dashboard_dark_logo">Dashboard Dark Logo</label>
                <input type="hidden" name="types[]" value="dashboard_dark_logo">
                <div class="qp-image-drop rounded">
                  <span class="fw-semibold">Choose Dark Logo</span>
                  <!-- choose media -->
                  <div class="qp-logo-image show-selected-files mt-3">
                    <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                      onclick="showMediaManager(this)" data-selection="single">
                      <input type="hidden" name="dashboard_dark_logo" value="{{ getSetting('dashboard_dark_logo') }}">
                      <div class="qp-icon-btn qp-green rounded-circle">
                        <i class="fas fa-plus"></i>
                      </div>
                    </div>
                  </div>
                  <!-- choose media -->
                </div>
              </div>
            </div> <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="favicon">Favicon</label>
                <input type="hidden" name="types[]" value="favicon">
                <div class="qp-image-drop rounded">
                  <span class="fw-semibold">Choose Favicon</span>
                  <!-- choose media -->
                  <div class="qp-favicon-image show-selected-files mt-3">
                    <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                      onclick="showMediaManager(this)" data-selection="single">
                      <input type="hidden" name="favicon" value="{{ getSetting('favicon') }}">
                      <div class="qp-icon-btn qp-green rounded-circle">
                        <i class="fas fa-plus"></i>
                      </div>
                    </div>
                  </div>
                  <!-- choose media -->
                </div>
              </div>
            </div> <!-- /.col -->
          </div> <!-- /.row -->
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->



  <div class="row">
    <div class="col-md-6">
      <!-- SEO Settings -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">SEO Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Type meta title"
              maxlength="60" value="{{ getSetting('meta_title') }}{{ old('meta_title') }}" required>
          </div>
          <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control" id="meta_description"
              placeholder="Type meta description" maxlength="175"
              required>{{ getSetting('meta_description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control" id="meta_keywords"
              placeholder="Type meta keywords">{{ getSetting('meta_keywords') }}</textarea>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <!-- Custom Scripts -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Custom Scripts</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="header_custom_script">Header Custom Script</label>
            <textarea name="header_custom_script" id="header_custom_script" class="form-control"
              rows="5">{{ getSetting('header_custom_script') }}</textarea>
          </div>
          <div class="form-group">
            <label for="footer_custom_script">Footer Custom Script</label>
            <textarea name="footer_custom_script" id="footer_custom_script" class="form-control"
              rows="5">{{ getSetting('footer_custom_script') }}</textarea>
          </div>
          <div class="form-group">
            <label for="custom_css">Custom Css</label>
            <textarea name="custom_css" id="custom_css" class="form-control"
              rows="5">{{ getSetting('custom_css') }}</textarea>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-md-6">
      <!-- Google Analytics -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Google Analytics</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="enable_google_analytics">Enable Google Analytics</label>
            <div class="form-group">
              <input type="checkbox" name="enable_google_analytics" data-bootstrap-switch data-on-text="Yes"
                data-off-text="No" {{ getSetting('enable_google_analytics')=='1' ? 'checked' : '' }}>
            </div>
          </div>
          <div class="form-group">
            <label for="google_analytics_tracking_id">Tracking ID</label>
            <input type="text" name="google_analytics_tracking_id" id="google_analytics_tracking_id"
              class="form-control" value="{{ getSetting('google_analytics_tracking_id') }}">
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <!-- Cookie Consent -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Google Recaptcha V3</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="enable_recaptcha">Enable Recaptcha</label>
            <div class="form-group">
              <input type="checkbox" name="enable_recaptcha" data-bootstrap-switch data-on-text="Yes" data-off-text="No"
                {{ getSetting('enable_recaptcha')=='1' ? 'checked' : '' }}>
            </div>
          </div>
          <div class="form-group">
            <label for="recaptcha_site_key">Recaptcha Site Key</label>
            <input type="text" name="recaptcha_site_key" class="form-control" id="recaptcha_site_key" maxlength="256"
              placeholder="Enter Recaptcha Site Key" value="{{ getSetting('recaptcha_site_key') }}">
          </div>
          <div class="form-group">
            <label for="recaptcha_secret_key">Recaptcha Secret Key</label>
            <input type="text" name="recaptcha_secret_key" class="form-control" id="recaptcha_secret_key"
              maxlength="256" placeholder="Enter Recaptcha Secret Key" value="{{ getSetting('recaptcha_secret_key') }}">
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <!-- Cookie Consent -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Cookie Consent</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="enable_cookie_consent">Enable Cookie Consent</label>
            <div class="form-group">
              <input type="checkbox" name="enable_cookie_consent" data-on-text="Yes" data-off-text="No" {{
                getSetting('enable_cookie_consent')=='1' ? 'checked' : '' }}>
            </div>
          </div>
          <div class=" form-group">
            <label for="cookie_consent_text">Cookie Consent Text</label>
            <textarea name="cookie_consent_text"
              id="cookie_consent_text">{{ getSetting('cookie_consent_text') }}</textarea>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class=" row">
    <div class="col-md-12">
      <!-- Maintenance Mode -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Maintenance Mode</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="maintenance_mode">Enable Maintenance Mode</label>
            <div class="form-group">
              <input type="checkbox" name="maintenance_mode" data-bootstrap-switch data-on-text="Yes" data-off-text="No"
                {{ getSetting('maintenance_mode')=='1' ? 'checked' : '' }}>
            </div>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <button type="submit" name="saveGeneralSettings" class="btn btn-flat btn-primary"
            id="saveGeneralSettings">Save
            Settings</button>
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
  // runs when the document is ready --> for media files
  $(document).ready(function() {        
    getChosenFilesCount();        
    showSelectedFilePreviewOnLoad();        
  });

  $(function () {

    $('#short_description').summernote({
      height: 100, // set editor height
    })
    $('#cookie_consent_text').summernote({
      height: 100, // set editor height
    })

    $("[name='enable_preloader']").bootstrapSwitch(false);
    $("[name='enable_cookie_consent']").bootstrapSwitch(false);
    $("[name='enable_recaptcha']").bootstrapSwitch(false);
    $("[name='maintenance_mode']").bootstrapSwitch(false);
    $("[name='enable_google_analytics']").bootstrapSwitch(false);
});
</script>
@stop