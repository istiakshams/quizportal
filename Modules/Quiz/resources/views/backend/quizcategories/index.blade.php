@extends('adminlte::page')

@section('title', 'Quiz Categories')

@section('content_header')
<h1>Quiz Categories</h1>
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quiz Categories</h3>
      </div> <!-- /.card-header -->
      <div class="card-body">
        <table id="CategoriesTable" class="table table-striped">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Name</th>
              <th width="15%"></th>
              <th width="15%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $categories as $category )
            <tr>
              <td width="5%">{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td><a href="/admin/quizzes/categories/{{ $category->id }}/edit"
                  class="btn btn-block btn-flat btn-primary"><i class="far fa-edit"></i> Edit</td>
              <td>
                <form action="/admin/quizzes/categories/{{ $category->id }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" onclick="return confirm('Are you sure?')"
                    class="btn btn-block btn-flat btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
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
  <div class="col-md-6">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Add Quiz Category</h3>
      </div> <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="/admin/quizzes/categories" role="form">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter quiz category name"
              value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Enter meta title"
              value="">
          </div>
          <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control" id="meta_description"
              placeholder="Enter meta description"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="saveQuizCategory" class="btn btn-flat btn-primary" id="saveQuizCategory"><i
                class="far fa-save"></i> Save</button>
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