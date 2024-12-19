@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
<h1>Edit Member</h1>
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/members/{{ $user->id }}" enctype="multipart/form-data" role="form">
  {{ method_field('PATCH') }}
  {{ csrf_field() }}
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Edit Member Details</h3>
    </div> <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
          </div>
        </div> <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"
              value="{{ $user->phone }}">
          </div>
        </div> <!-- /.col -->
      </div> <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
              value="{{ $user->email }}">
          </div>
        </div> <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="">
          </div>
        </div> <!-- /.col -->
      </div> <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control">
              @foreach( $roles as $role )
              <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->implode(', ') == $role->id ? 'selected' : ''
                }}>{{ $role->name }}</option>
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
        <button type="submit" name="updateMember" class="btn btn-flat btn-primary" id="updateMember"><i
            class="far fa-save"></i> Update</button>
        <a class="btn btn-flat btn-secondary float-right" href="/admin/members"><i class="fas fa-share"></i> Back</a>
      </div>
    </div>
  </div> <!-- /.card -->
</form>
@stop