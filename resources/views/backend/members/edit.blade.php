@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
    <h1>Edit Member</h1>
@stop

@section('content')

@include('notifications')

  <div class="row">
    <div class="col-md-12">

      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Member Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="/admin/members/{{ $user->id }}" enctype="multipart/form-data" role="form">

          {{ method_field('PATCH') }}
          {{ csrf_field() }}

          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
              <label for="paymentstatus">Payment Status</label>
              <select name="paymentstatus" class="form-control">                
                <option value="None" {{ $user->paymentstatus == 'None' ? 'selected' : '' }}>None</option>
                <option value="Pending" {{ $user->paymentstatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $user->paymentstatus == 'Completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </div>            

            <div class="form-group">
              <label for="paymenttype">Payment Type</label>
              <select name="paymenttype" class="form-control">                
                <option value="None" {{ $user->paymenttype == 'None' ? 'selected' : '' }}>None</option>
                <option value="bKash" {{ $user->paymenttype == 'bKash' ? 'selected' : '' }}>bKash</option>
                <option value="Nagad" {{ $user->paymenttype == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                <option value="Rocket" {{ $user->paymenttype == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                <option value="Payoneer" {{ $user->paymenttype == 'Payoneer' ? 'selected' : '' }}>Payoneer</option>
                <option value="Other" {{ $user->paymenttype == 'Other' ? 'selected' : '' }}>Other</option>
              </select>
            </div>

            <div class="form-group">
              <label for="paymentphone">Payment Phone</label>
              <input type="text" name="paymentphone" class="form-control" id="paymentphone" placeholder="Transaction Id" value="{{ $user->paymentphone }}">
            </div>            

            <div class="form-group">
              <label for="transactionid">Transaction Id</label>
              <input type="text" name="transactionid" class="form-control" id="transactionid" placeholder="Transaction Id" value="{{ $user->transactionid }}">
            </div>

            <div class="form-group">
              <label for="role">Role</label>
              <select name="role" class="form-control">
                @foreach( $roles as $role )
                  <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->implode(', ') == $role->id ? 'selected' : '' }}> {{ $role->name }}
                @endforeach
              </select>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="form-group">
              <button type="submit" name="updateMember" class="btn btn-primary" id="updateMember">Update</button>
              <a class="btn btn-success float-right" href="/admin/members"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@stop
