@extends('adminlte::page')

@section('title', 'Polls')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1>Polls</h1>
        <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/polls">Polls</a> / All Polls</p>
    </div> <!-- /.col -->
    <div class="col-6">
        <p><a href="/admin/polls/create" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add New</a>
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
                <h3 class="card-title">All Polls</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="PollsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Image</th>
                            <th>Poll Question</th>
                            <th width="7%">Choices</th>
                            <th width="7%">Multiple Choices?</th>
                            <th width="7%">Can Visitors Vote</th>
                            <th width="10%">Author</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $polls as $poll )
                        <tr>
                            <td width="5%">{{ $poll->id }}</td>
                            <td width="5%">
                                @if( !empty($poll->image) )
                                <img src="{{ getImage($poll->image) }}" alt="{{ $poll->question }}" width="150px">
                                @else
                                <img src="/images/choice-no-image.jpg" alt="{{ $poll->question }}" width="150px">
                                @endif
                            </td>
                            <td>
                                {{ $poll->question }}
                                <br>
                                <a href="{{ URL::to('/') }}/poll/{{ $poll->slug }}" target="_blank" class="text-xs">{{
                                    URL::to('/') }}/poll/{{$poll->id }}</a>
                            </td>
                            <td>{{ $poll->choices->count() }}</td>
                            <td>{{ $poll->maxCheck == 1 ? 'Yes' : 'No' }}</td>
                            <td>{{ $poll->canVisitorsVote == 1 ? 'Yes' : 'No' }}</td>
                            <td>{{ getUserName($poll->author_id) }}</td>
                            <td>{{ ucwords($poll->status) }}</td>
                            <td>
                                <a href="/admin/polls/{{ $poll->id }}/edit"
                                    class="btn btn-flat btn-block btn-primary"><i class="far fa-edit"></i> Edit</a>
                            </td>
                            <td>
                                <form action="/admin/polls/{{ $poll->id }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-flat btn-block btn-danger"><i class="far fa-trash-alt"></i>
                                        Delete</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Image</th>
                            <th>Poll Question</th>
                            <th width="7%">Choices</th>
                            <th width="7%">Multiple Choices?</th>
                            <th width="7%">Can Visitors Vote</th>
                            <th width="10%">Author</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                            <th width="10%">Action</th>
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
    $('#PollsTable').DataTable({
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