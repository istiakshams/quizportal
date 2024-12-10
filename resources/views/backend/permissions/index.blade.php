@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
<h1>Permissions</h1>
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Permissions</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <table id="PermissionList" class="table table-bordered">
          <thead>
            <tr>
              <th>Permission</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $permissions as $permission )
            <tr>
              <td>{{ $permission->name }}</td>
              <td><a href="/admin/members/permissions/{{ $permission->id }}/edit" class="btn btn-primary"><i
                    class="far fa-edit"></i></a></td>
              <td>
                <form action="/admin/members/permissions/{{ $permission->id }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i
                      class="far fa-trash-alt"></i></a>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Permission</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </tr>
          </tfoot>
        </table>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add Permission</h3>
      </div> <!-- /.card-header -->
      <form method="POST" action="/admin/members/permissions" role="form">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="permissions">Assign Permission To Roles</label>
            <div class="form-group">
              @foreach( $roles as $role )
              <div class="form-group col-3">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
              </div>
              @endforeach
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-footer">
          <div class="form-group">
            <button type="submit" name="addPermission" class="btn btn-primary" id="addPermission">Add
              Permission</button>
          </div>
        </div> <!-- /.card-footer -->
      </form>
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop

@section('adminlte_js')
<script>
  $(function () {
    $('#PermissionList').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [1,2],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)