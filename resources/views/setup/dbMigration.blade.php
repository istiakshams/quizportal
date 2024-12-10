@extends('setup.master')
@section('contents')
<div class="card ">
    <div class="card-header">
        <div class="mar-ver pad-btm text-center">
            <h1 class="h3">Run Database Migration</h1>
            <p>Your database is successfully connected. Please run migration to configure the
                database.</p>
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
        <div class="d-flex align-items-center justify-content-center mt-4">
            <a href="{{ route('installation.dbSetup') }}" class="btn btn-secondary me-2"><i
                    class="las la-arrow-left"></i>
                Previous</a>

            <a href="{{ route('installation.runMigration') }}" class="btn btn-primary" onclick="showLoder()">Run
                Migration <i class="las la-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection