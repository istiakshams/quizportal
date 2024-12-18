@extends('adminlte::page')

@section('title', 'Blogs')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Blogs</h1>
  </div> <!-- /.col -->
  <div class="col-6">
    <p><a href="/admin/blogs/create" class="btn btn-flat btn-primary float-right"><i class="fas fa-plus"></i> Add
        New</a></p>
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Blogs</h3>
      </div> <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table id="BlogsTable" class="table table-hover">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Thumbnail</th>
              <th>Title</th>
              <th width="10%">Category</th>
              <th width="10%">Author</th>
              <th width="10%">Featured</th>
              <th width="10%">Status</th>
              <th width="8%">Action</th>
              <th width="8%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $blogs as $blog )
            <tr>
              <td width="5%">{{ $blog->id }}</td>
              <td><img src="{{ getFeaturedImage($blog->featured_image) }}" alt="{{ $blog->title }}" width="150px" />
              </td>
              <td>
                {{ $blog->title }}
                <br>
                <a href="{{ URL::to('/') }}/blog/{{ $blog->slug }}" target="_blank" class="text-xs">{{ URL::to('/')
                  }}/blog/{{$blog->slug }}</a>
              </td>
              <td>{{ str_replace( array('[',']','"'), '', $blog->categories()->pluck('name') ) }}</td>
              <td>{{ getUserName($blog->author_id) }}</td>
              <td>{{ $blog->is_featured == 0 ? 'No' : 'Yes' }}</td>
              <td>{{ ucwords($blog->status) }}</td>
              <td>
                <a href="/admin/blogs/{{ $blog->id }}/edit" class="btn btn-flat btn-block btn-primary"><i
                    class="far fa-edit"></i> Edit</a>
              </td>
              <td>
                <form action="/admin/blogs/{{ $blog->id }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" onclick="return confirm('Are you sure?')"
                    class="btn btn-flat btn-block btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th width="5%">ID</th>
              <th>Thumbnail</th>
              <th>Title</th>
              <th>Category</th>
              <th>Author</th>
              <th>Featured</th>
              <th>Status</th>
              <th>Action</th>
              <th>Action</th>
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
    $('#BlogsTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [1,7],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)