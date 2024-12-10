@extends('setup.master')
@section('contents')
<div class="card">
    <div class="card-header">
        <h1>Installation</h1>
        <p>You need to know the mentioned informations before proceeding.</p>
    </div>
    <div class="card-body">
        <ol>
            <li>Database Name</li>
            <li>Database Username</li>
            <li>Database Password</li>
            <li>Database Hostname</li>
        </ol>
        <br>
        <a href="{{ route('installation.checklist') }}" class="btn btn-primary"> Proceed to Next <i
                class="fas fa-arrow-right"></i></a>
    </div>
</div>
</div>
</div>
</div>
@endsection