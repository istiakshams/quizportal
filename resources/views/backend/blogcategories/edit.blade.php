@extends('adminlte::page')

@section('title', 'Edit Blog Category')

@section('content_header')
<h1>Edit Blog Category</h1>
@stop

@section('content')

@include('notifications')

<!-- form start -->
<form method="POST" action="/admin/blog-categories/{{ $category->id }}" role="form">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Category Details</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name"
              value="{{ $category->name }}">
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
      <!-- SEO Settings -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">SEO Settings</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Type meta title"
              value="{{ $category->meta_title }}">
          </div>

          <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control" id="meta_description"
              placeholder="Type meta description">{{ $category->meta_description }}</textarea>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->

      <div class="card card-default">
        <div class="card-body">
          <div class="form-group">
            <button type="submit" name="updateCategory" class="btn btn-primary" id="addCategory">Update</button>
            <a class="btn btn-success float-right" href="/admin/blog-categories">Back</a>
          </div>
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
</form>
@stop