@extends('adminlte::page')

@section('title', 'Footer Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Footer Settings</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')
<!-- form start -->
<form method="POST" action="/admin/appearance/footer-settings" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Footer Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="footer_logo">Footer Logo</label>
            <input type="hidden" name="types[]" value="footer_logo">
            <div class="qp-image-drop rounded">
              <!-- choose media -->
              <div class="qp-logo-image show-selected-files mt-3">
                <span class="fw-semibold">Choose Footer Logo</span>
                <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                  onclick="showMediaManager(this)" data-selection="single">
                  <input type="hidden" name="footer_logo" value="{{ getThemeSetting('footer_logo') }}">
                  <div class="qp-icon-btn qp-green rounded-circle">
                    <i class="fas fa-plus"></i>
                  </div>
                </div>
              </div>
              <!-- choose media -->
            </div>
          </div>
          <div class="form-group">
            <label for="footer_about_us">Footer About Us</label>
            <textarea name="footer_about_us"
              id="footer_about_us">{{ getThemeSetting('footer_about_us', '') }}</textarea>
          </div>
          <div class="form-group">
            <label for="footer_newsletter">Newsletter</label>
            <textarea name="footer_newsletter"
              id="footer_newsletter">{{ getThemeSetting('footer_newsletter', '') }}</textarea>
          </div>
          <div class="form-group">
            <label for="site_logo_white">Copyright Text</label>
            <textarea name="copyright_text" id="copyright_text">{{ getThemeSetting('copyright_text', '') }}</textarea>
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
            <button type="submit" name="saveFooterSettings" class="btn btn-primary"
              id="saveFooterSettings">Save</button>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

</form>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Summernote', true)
@section('adminlte_js')
<script>
  // runs when the document is ready --> for media files
  $(document).ready(function() {
    getChosenFilesCount();
    showSelectedFilePreviewOnLoad();
  });

  $(function () {
    $('#footer_about_us').summernote({
        height: 100, // set editor height
    });        
    $('#footer_newsletter').summernote({            
      height: 100, // set editor height            
    });            
    $('#copyright_text').summernote({                
      height: 100, // set editor height                
    });
});
</script>
@stop