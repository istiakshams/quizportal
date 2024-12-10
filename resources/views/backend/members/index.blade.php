@extends('adminlte::page')

@section('title', 'Members')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Members</h1>
  </div> <!-- /.col -->
  <div class="col-6">
    <p><a href="/admin/members/create" class="btn btn-primary float-right">Add New</a></p>
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Members</h3>
      </div><!-- /.card-header -->
      <div class="card-body">

        <table id="MembersTable" class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actrive Package</th>
              <th>Status</th>
              <th width="15%"></th>
            </tr>
          </thead>
          <tbody>

            @foreach( $users as $user )
            <tr>
              <td width="5%">{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>Phone</td>
              <td>Packages</td>
              <td>Status</td>
              <td>
                <div class="row">
                  <div class="col-md-6 text-center">
                    <a href="/admin/members/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="col-md-6 text-center">

                    <form action="/admin/members/{{ $user->id }}" method="post">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Delete</a>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach

          </tbody>
          <tfoot>
            <tr>
              <th width="5%">ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actrive Package</th>
              <th>Status</th>
              <th width="15%"></th>
            </tr>
          </tfoot>
        </table>

      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop

@section('adminlte_js')
<script>
  $(function () {
    $('#MembersTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [6,7,8],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)