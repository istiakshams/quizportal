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
      <div class="card-body table-responsive">
        <table id="CategoriesTable" class="table table-hover">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Name</th>
              <th width="12%">Default Categroy</th>
              <th width="8%"></th>
              <th width="8%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $categories as $category )
            <tr>
              <td width="5%">{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>
                @if( $category->isDefault == 1 )
                <button type="submit" class="btn btn-flat btn-block btn-secondary">Default Category</button>
                @else
                <form action="/admin/blog-categories/set-default/{{ $category->id }}" method="post">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-flat btn-block btn-primary">Set Default</button>
                </form>
                @endif
              </td>
              <td><a href="/admin/blog-categories/{{ $category->id }}/edit"
                  class="btn btn-flat btn-block btn-primary"><i class="far fa-edit"></i> Edit</td>
              <td>
                @if( $category->isDefault == 1 )
                <button type="submit" class="btn btn-flat btn-block btn-secondary"><i class="far fa-trash-alt"></i>
                  Delete</button>
                @else
                <form action="/admin/blog-categories/{{ $category->id }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" onclick="return confirm('Are you sure?')"
                    class="btn btn-flat btn-block btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                </form>
                @endif
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
            <button type="submit" name="saveCategory" class="btn btn-flat btn-primary" id="saveCategory">Save</button>
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
        "targets": [2,3,4],
        "orderable": false
      }]
    });


  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)
@section('plugins.BootstrapSwitch', true)