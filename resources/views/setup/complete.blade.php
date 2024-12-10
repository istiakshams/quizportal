@extends('setup.master')
@section('contents')
<div class="card ">
    <div class="card-header">
        <div class="mar-ver pad-btm text-center">
            <h1 class="h3">Complete</h1>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body p-5 text-center">
            <div class="mb-4"><i class="las la-check-circle text-primary fs-1"></i></div>
            <div class="mb-4">
                <h1 class="h3">Congratulations!!!</h1>
                <p>You have successfully completed the installation process.</p>
            </div>
            <a href="{{ env('APP_URL') }}" class="btn btn-secondary me-2">Browse Website</a>
            <a href="{{ env('APP_URL') }}/dashboard" class="btn btn-primary">Browse Admin panel</a>
        </div>
    </div>
</div>
@endsection