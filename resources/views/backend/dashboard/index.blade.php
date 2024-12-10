@extends('adminlte::page')

@section('title', 'Dashboard')

@section('preloader')
<i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
<h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Dashboard</h1>


    <i class="fa-solid fa-house"></i>
  </div> <!-- /.col -->
  <div class="col-6">

  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <x-adminlte-date-range name="drBasic" />



  </div> <!-- /.col -->
</div> <!-- /.row -->

@stop
@section('plugins.jQuery-UI', true)