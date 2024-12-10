@extends('adminlte::page')

@section('title', 'Edit Language')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Edit Language</h1>
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
                <h3 class="card-title">Edit Language</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <form action="/admin/settings/languages/{{ $language->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ localize('Language Name') }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="{{ localize('Type language name') }}" class="form-control"
                            value="{{ $language->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="code">{{ localize('ISO 639-1 Code') }}</label>
                        <input type="text" name="code" class="form-control" id="code"
                            placeholder="{{ localize('en/bn') }}" class="form-control" value="{{ $language->code }}" {{
                            $language->id == 1 ? 'disabled' : '' }} required>
                    </div>
                    <div class="form-group">
                        <label for="flag">{{ localize('Flag') }}</label>
                        <select name="flag" class="form-control country-flag-select" id="flag" data-toggle="select2">
                            @foreach (\File::files(base_path('public/images/flags')) as $path)
                            <option value="{{ pathinfo($path)['filename'] }}"
                                data-flag="{{ staticAsset('images/flags/' . pathinfo($path)['filename'] . '.png') }}" {{
                                $language->flag == pathinfo($path)['filename'] ? 'selected' : '' }}>{{
                                strtoupper(pathinfo($path)['filename']) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_rtl">{{ localize('Is RTL ?') }}</label>
                        <select id="is_rtl" class="form-control select2" name="is_rtl" data-toggle="select2">
                            <option value="0" {{ $language->is_rtl == 0 ? 'selected' : '' }}>
                                {{ localize('No') }}
                            </option>
                            <option value="1" {{ $language->is_rtl == 1 ? 'selected' : '' }}>
                                {{ localize('Yes') }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="updateLanguage" class="btn btn-primary" id="updateLanguage">{{
                            localize('Update Language') }}</button>
                        <a class="btn btn-secondary float-right" href="/admin/settings/language-settings">Back</a>
                    </div>
                </form>
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
    $("[name='set_multiLangual']").bootstrapSwitch(false);
    $("[name='set_forTemplate']").bootstrapSwitch(false);
  });

  function updateStatus(el) {

    if( el.checked ) {                
      var is_active = 1;            
    } else {                
      var is_active = 0;            
    }
            
    $.post('{{ route('admin.languages.updateStatus') }}', {                    
      _token: '{{ csrf_token() }}',                    
      id: el.value,                    
      is_active: is_active                
    },                
    function(data) {
      if (data.status == true) {        
        $(document).Toasts('create', {              
          class: 'bg-success',
          fade: true,
          autohide: true,
          delay: 2000,
          title: 'Success',
          body: data.message
        });
      }
      else {
        $(document).Toasts('create', {
          class: 'bg-danger',
          fade: true,
          autohide: true,
          delay: 2000,
          title: 'Error',
          body: data.message
        });        
      }
    });
  }

        
  function updateTemplateStatus(el) {

    if (el.checked) {                
      var is_active_for_templates = 1;            
    } else {                
      var is_active_for_templates = 0;            
    }
            
    $.post('{{ route('admin.languages.updateTemplateStatus') }}', {                    
      _token: '{{ csrf_token() }}',                    
      id: el.value,                    
      is_active_for_templates: is_active_for_templates                
    },                
    function(data) {
      if (data.status == true) {
        $(document).Toasts('create', {
          class: 'bg-success',
          fade: true,
          autohide: true,
          delay: 2000,
          title: 'Success',
          body: data.message
      });
    } 
    else {
        $(document).Toasts('create', {
          class: 'bg-danger',
          fade: true,
          autohide: true,
          delay: 2000,
          title: 'Error',
          body: data.message
        });
      }
    });        
  }
</script>
@stop