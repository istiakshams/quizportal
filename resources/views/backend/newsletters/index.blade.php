@extends('adminlte::page')

@section('title', 'Send Newsletter')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Send Newsletter</h1>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">


  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop
@section('plugins.jQuery-UI', true)