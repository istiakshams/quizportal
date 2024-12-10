@extends('adminlte::page')

@section('title', 'Add Permission')

@section('content_header')
<h1>Add Permission</h1>
@stop

@section('content')

@include('errors')

@if(session()->has('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-check"></i> Success!</h4>
  {{ session()->get('message') }}
</div>
@endif

<div class="box box-solid">
  <div class="box-body">
    <form method="POST" action="/admin/members/permissions" role="form">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Permission Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
      </div>
      <div class="form-group">
        <label for="permissions">Assign Permission To Roles</label>
        @foreach( $roles as $role )
        <div class="checkbox">
          <label>
            <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
          </label>
        </div>
        @endforeach
      </div>
      <div class="form-group">
        <button type="submit" name="addPermission" class="btn btn-primary" id="addPermission">Add Permission</button>
      </div>
    </form>
  </div>

</div>
<!-- /.box-body -->
</div>
<!-- /.box -->


@stop