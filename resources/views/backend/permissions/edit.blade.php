@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('content_header')
<h1>Edit Permission</h1>
@stop

@section('content')

@include('notifications')
<form method="POST" action="/admin/members/permissions/{{ $permission->id }}" role="form">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="row">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Permission Name</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name"
              value="{{ $permission->name }}">
          </div>
          <div class="form-group">
            <button type="submit" name="updatePermission" class="btn btn-primary" id="updatePermission">Update
              Permission</button>
            <a class="btn btn-success float-right" href="/admin/members/permissions"><i
                class="far fa-arrow-alt-circle-left"></i>
              Back</a>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Assign Permission To Roles</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            @foreach( $roles as $role )
            <div class="form-group col-12">
              <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $role->hasPermissionTo($permission->name)
              ? 'checked' : '' }}> {{ $role->name }}
            </div>
            @endforeach
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
</form>
@stop