@extends('adminlte::page')

@section('title', 'Add Member')

@section('content_header')
<h1>Add Member</h1>
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/members" enctype="multipart/form-data" role="form">
  {{ csrf_field() }}

  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">New Member Details</h3>
    </div> <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
          </div>
        </div> <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"
              value="{{ old('phone') }}">
          </div>
        </div> <!-- /.col -->
      </div> <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
              value="{{ old('email') }}">
          </div>
        </div> <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" id="password" placeholder="Password"
              value="{{ old('password') }}">
          </div>
        </div> <!-- /.col -->
      </div> <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control">
              @foreach( $roles as $role )
              <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
        </div> <!-- /.col -->
        <div class="col-md-6">

        </div> <!-- /.col -->
      </div> <!-- /.row -->
    </div> <!-- /.card-body -->
    <div class="card-footer">
      <div class="form-group">
        <button type="submit" name="saveMember" class="btn btn-primary" id="saveMember">Save</button>
        <a class="btn btn-success float-right" href="/admin/members"> Back</a>
      </div>
    </div>
  </div> <!-- /.card -->
</form>
@stop