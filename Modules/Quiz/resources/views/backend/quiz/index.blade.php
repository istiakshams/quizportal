@extends('adminlte::page')

@section('title', 'Quizzes')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Quizzes</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/quizzes">Quizzes</a> / All Quizzes</p>
    </div> <!-- /.col -->
    <div class="col-6">
        <p><a href="/admin/quizzes/create" class="btn btn-flat btn-primary float-right"><i class="fas fa-plus"></i> Add
                New</a>
        </p>
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Quizzes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="QuizzesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th width="10%">Category</th>
                            <th width="10%">Type</th>
                            <th width="10%">Author</th>
                            <th width="10%">Featured</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $quizzes as $quiz )
                        <tr>
                            <td width="5%">{{ $quiz->id }}</td>
                            <td width="5%">
                                @if( !empty($quiz->image) )
                                <img src="{{ getImage($quiz->image) }}" alt="{{ $quiz->title }}" width="150px">
                                @else
                                <img src="/images/choice-no-image.jpg" alt="{{ $quiz->title }}" width="150px">
                                @endif
                            </td>
                            <td>
                                {{ $quiz->title }}
                                <br>
                                <a href="{{ URL::to('/') }}/quiz/{{ $quiz->slug }}" target="_blank" class="text-xs">{{
                                    URL::to('/') }}/quiz/{{$quiz->slug }}</a>
                            </td>
                            <td>{{ $quiz->category->name }}</td>
                            <td>{{ ucwords($quiz->type) }}</td>
                            <td>{{ getUserName($quiz->author_id) }}</td>
                            <td>{{ $quiz->is_featured == 0 ? 'No' : 'Yes' }}</td>
                            <td>{{ ucwords($quiz->status) }}</td>
                            <td>
                                <a href="/admin/quizzes/{{ $quiz->id }}/edit" class="btn btn-block btn-primary"><i
                                        class="far fa-edit"></i> Edit</a>
                            </td>
                            <td>
                                <form action="/admin/quizzes/{{ $quiz->id }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
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
    $('#QuizzesTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [1,8,9],
        "orderable": false
      }]
    })
  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)