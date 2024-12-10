@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Pages</h1>
  </div> <!-- /.col -->
  <div class="col-6">
    <p><a href="/admin/pages/create" class="btn btn-primary float-right">Add New</a></p>
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Pages</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table id="PagesTable" class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Title</th>
              <th width="10%">Status</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $pages as $page )
            <tr>
              <td width="5%">{{ $page->id }}</td>
              <td>
                {{ $page->title }}
                <br>
                @if( isDefaultPage($page->id) )
                <a href="{{ URL::to('/') }}/{{ $page->slug }}" target="_blank" class="text-xs">{{ URL::to('/')
                  }}/{{$page->slug }}</a>
                @else
                <a href="{{ URL::to('/') }}/page/{{ $page->slug }}" target="_blank" class="text-xs">{{ URL::to('/')
                  }}/page/{{$page->slug }}</a>
                @endif
              </td>
              <td>{{ ucfirst($page->status) }}</td>
              <td>
                <div class="row">
                  <div class="col-md-6 text-center">
                    <a href="/admin/pages/{{ $page->id }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="col-md-6 text-center">
                    @if( !isDefaultPage($page->id) )
                    <form action="/admin/pages/{{ $page->id }}" method="post">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    </form>
                    @else
                    <button type="submit" class="btn btn-secondary" disabled>Delete</a>
                      @endif
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th width="5%">ID</th>
              <th>Title</th>
              <th>Status</th>
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
    $('#PagesTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [3],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)