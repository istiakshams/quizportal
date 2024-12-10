@extends('adminlte::page')

@section('title', 'Add Role')

@section('content_header')
<h1>Add Role</h1>
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
    <form method="POST" action="/admin/members/roles" role="form">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
      </div>
      <div class="form-group">
        <label for="permissions">Assign Permissions</label>
        @foreach( $permissions as $permission )
        <div class="checkbox">
          <label>
            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ $permission->name }}
          </label>
        </div>
        @endforeach
      </div>
      <div class="form-group">
        <button type="submit" name="addRole" class="btn btn-primary" id="addRole">Add Role</button>
      </div>
    </form>
  </div>

</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@stop