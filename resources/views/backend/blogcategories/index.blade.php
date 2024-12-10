@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
<h1>Blog Categories</h1>
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Blog Categories</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <table id="CategoriesTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Name</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $categories as $category )
            <tr>
              <td width="5%">{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td><a href="/admin/blog-categories/{{ $category->id }}/edit" class="btn btn-primary">Edit</td>
              <td>
                <form action="/admin/blog-categories/{{ $category->id }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Add Category</h3>
      </div> <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="/admin/blog-categories" role="form">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name"
              value="{{ old('name') }}">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="form-group">
            <button type="submit" name="saveCategory" class="btn btn-primary" id="saveCategory">Save</button>
          </div>
        </div>
      </form>
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop
@section('adminlte_js')
<script>
  $(function () {
    $('#CategoriesTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [2,3],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)