@extends('adminlte::page')

@section('title', 'Language Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Language Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Language Settings</p>
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
        <h3 class="card-title">Language Settings</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <table id="PagesTable" class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">{{ localize('No') }}</th>
              <th>{{ localize('Name') }}</th>
              <th>{{ localize('ISO 639-1 Code') }}</th>
              <th>{{ localize('MultiLangual Support') }}</th>
              <th>{{ localize('Show In Templates') }}</th>
              <th>{{ localize('Action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($languages as $key => $language)
            <tr>
              <td class="text-center">
                {{ $loop->index + 1 }}
              </td>
              <td>
                <span class="d-flex align-items-center">
                  <div class="qp-flags">
                    <img src="{{ staticAsset('images/flags/' . $language->flag . '.png') }}"
                      alt="{{ $language->flag }}" />
                  </div>
                  {{ $language->name }}
                </span>
              </td>
              <td>
                {{ $language->code }}
              </td>
              <td>
                {{-- @can('publish_languages') --}}
                <div class="form-group">
                  <input type="checkbox" name="set_multiLangual" {{ $language->is_active == '1' ? 'checked' : '' }}
                  value="{{ $language->id }}" data-bootstrap-switch onchange="updateStatus(this)">
                </div>
                {{-- @endcan --}}
              </td>
              <td>
                {{-- @can('publish_languages') --}}
                <div class="form-group">
                  <input type="checkbox" name="set_forTemplate" {{ $language->is_active_for_templates == '1' ? 'checked'
                  : '' }} value="{{ $language->id }}" data-bootstrap-switch onchange="updateTemplateStatus(this)">
                </div>
                {{-- @endcan --}}
              </td>
              <td>
                <div class="row">
                  <div class="col-md-6 text-center">
                    <a href="/admin/settings/languages/{{ $language->id }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="col-md-6 text-center">
                    <a href="/admin/settings/languages/localizations/{{ $language->id }}"
                      class="btn btn-primary">Localizations</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Add New Language</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('admin.languages.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="name">{{ localize('Language Name') }}</label>
            <input type="text" name="name" class="form-control" id="name"
              placeholder="{{ localize('Type language name') }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="code">{{ localize('ISO 639-1 Code') }}</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="{{ localize('en/bn') }}"
              class="form-control" required>
          </div>
          <div class="form-group">
            <label for="flag">{{ localize('Flag') }}</label>
            <select name="flag" class="form-control country-flag-select" id="flag" data-toggle="select2">
              @foreach (\File::files(base_path('public/images/flags')) as $path)
              <option value="{{ pathinfo($path)['filename'] }}"
                data-flag="{{ staticAsset('images/flags/' . pathinfo($path)['filename'] . '.png') }}">
                {{ strtoupper(pathinfo($path)['filename']) }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="is_rtl">{{ localize('Is RTL ?') }}</label>
            <select id="is_rtl" class="form-control select2" name="is_rtl" data-toggle="select2">
              <option value="0">
                {{ localize('No') }}
              </option>
              <option value="1">
                {{ localize('Yes') }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" name="SaveLanguage" class="btn btn-primary" id="SaveLanguage">{{
              localize('Save Language') }}</button>
          </div>
        </form>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">{{ localize('Set Default Language') }}</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <!-- form start -->
        <form action="{{ route('admin.languages.defaultLanguage') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="system_title">{{ localize('Default Language') }}</label>
            <select name="default_language" id="default_language" class="form-control country-flag-select"
              data-toggle="select2">
              @foreach ($languages as $key => $language)
              <option value="{{ $language->code }}" {{ env('DEFAULT_LANGUAGE')==$language->code ? 'selected' : '' }}
                data-flag="{{ staticAsset('images/flags/' . $language->flag . '.png') }}"> {{
                $language->name }} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <button type="submit" name="setLanguage" class="btn btn-primary" id="setLanguage">{{
              localize('Set Language') }}</button>
          </div>
        </form>
        <!-- form end -->
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->
<!--default lang info end-->

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