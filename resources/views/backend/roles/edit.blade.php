@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
<h1>Edit Role</h1>
@stop

@section('content')

@include('notifications')

<form method="POST" action="/admin/members/roles/{{ $role->id }}" role="form">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="row">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Role Name</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            {{-- <label for="name">Role Name</label> --}}
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $role->name }}">
          </div>
          <div class="form-group">
            <button type="submit" name="updateRole" class="btn btn-primary" id="updateRole">Update Role</button>
            <a class="btn btn-success float-right" href="/admin/members/roles">Back</a>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Assign Permissions</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            {{-- <label for="permissions">Assign Permissions</label> --}}
            <div class="row">
              @foreach( $permissions as $permission )
              <div class="form-group col-3">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{
                  $role->hasPermissionTo($permission->name) ? 'checked' : '' }}> {{ $permission->name }}
              </div>
              @endforeach
            </div>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->

</form>
@stop