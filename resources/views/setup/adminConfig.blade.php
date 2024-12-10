@extends('setup.master')
@section('contents')
<div class="card ">
    <div class="card-header">
        <div class="mar-ver pad-btm text-center">
            <h1 class="h3">Admin Configuration</h1>
            <p>Fill this form with basic information & admin login credentials</p>
        </div>

        @if (isset($error))
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <strong>Invalid Database Credentials!! </strong>Please check your database
                    credentials carefully
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('installation.storeAdmin') }}">
            @csrf
            <div class="form-group mb-2">
                <label class="fw-semibold mb-1" for="admin_name">Admin Name</label>
                <input type="text" class="form-control" id="admin_name" name="admin_name" required>
            </div>

            <div class="form-group mb-2">
                <label class="fw-semibold mb-1" for="admin_email">Admin Email</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
            </div>

            <div class="form-group mb-4">
                <label class="fw-semibold mb-1" for="admin_password">Admin Password (At least 8
                    characters)</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
            </div>

            <div class="d-flex align-items-center mt-4">
                <a href="{{ route('installation.migration') }}" class="btn btn-secondary me-2"><i
                        class="las la-arrow-left"></i>
                    Previous</a>
                <button type="submit" class="btn btn-primary">Continue <i class="las la-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection