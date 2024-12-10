@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
<h1>Roles</h1>
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Roles</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table id="RoleList" class="table table-bordered">
          <thead>
            <tr>
              <th>Roles</th>
              <th>Permission(s)</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>

            @foreach( $roles as $role )
            <tr>
              <td>{{ $role->name }}</td>
              <td>{{ formatPlucked($role->permissions) }}</td>
              <td><a href="/admin/members/roles/{{ $role->id }}/edit" class="btn btn-primary"><i
                    class="far fa-edit"></i></a></td>
              <td>
                <form action="/admin/members/roles/{{ $role->id }}" method="post">
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
              <th>Roles</th>
              <th>Permission(s)</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
  <!-- /.col -->
  <div class="col-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add Role</h3>
      </div>
      <!-- /.card-header -->
      <form method="POST" action="/admin/members/roles" role="form">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="permissions">Assign Permissions</label>
            <div class="row">
              @foreach( $permissions as $permission )
              <div class="form-group col-4">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ $permission->name }}
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="form-group">
            <button type="submit" name="addRole" class="btn btn-primary" id="addRole">Add Role</button>
          </div>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@stop

@section('adminlte_js')
<script>
  $(function () {
    $('#RoleList').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [1,2,3],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)