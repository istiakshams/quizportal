@extends('adminlte::page')

@section('title', 'Localizations')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Localizations</h1>
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
        <h3 class="card-title">Localizations</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <table id="PagesTable" class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">{{ localize('No') }}</th>
              <th>{{ localize('Lang Key') }}</th>
              <th>{{ localize('Localizations') }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($localizations as $key => $localization)
            <tr>
              <td class="text-center">
                {{ $localization->id }}
              </td>
              <td>
                {{ $localization->t_value }}
              </td>
              <td>
                <input type="text" class="form-control value w-100" name="values[{{ $localization->t_key }}]"
                  placeholder="{{ localize('Type localization here') }}" @if ( GetLocalization($language->code,
                $localization->t_key) !=null ) value="{{ GetLocalization($language->code,
                $localization->t_key)->t_value }}" @endif>
              </td>
              <td>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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


</script>
@stop