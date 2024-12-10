@extends('setup.master')
@section('contents')
<div class="card">
    <div class="card-header">
        <h1>Checking file permissions</h1>
        <p>We scanned your server.<br>
            If everything has green check mark, you are good to go to the next step.</p>
    </div>

    <div class="card-body">
        @php
        $phpVersion = number_format((float) phpversion(), 2, '.', '');
        @endphp
        <ul>
            <li>
                <span>Php version {{$phpVersion}}</span>
                @if ($phpVersion >= 8.1)
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Curl Enabled</span>


                @if ($permission['curl_enabled'])
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>File Get Contents</span>

                @if ($permission['file_get_contents'])
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>File Put Contents</span>

                @if ($permission['file_put_contents'])
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span><b>.env</b> File Permission</span>

                @php
                $phpVersion = number_format((float) phpversion(), 2, '.', '');
                @endphp
                @if ($permission['db_file_write_perm'])
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>

            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Zip/ZipArchive Extension</span>
                @if(extension_loaded('zip'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Fileinfo PHP Extension</span>
                @if(extension_loaded('fileinfo'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Ctype PHP Extension</span>
                @if(extension_loaded('ctype'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>



            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>JSON PHP Extension</span>
                @if(extension_loaded('json'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>OpenSSL PHP Extension</span>
                @if(extension_loaded('openssl'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Tokenizer PHP Extension</span>
                @if(extension_loaded('tokenizer'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span>Mbstring PHP Extension</span>
                @if(extension_loaded('mbstring'))
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
            <li class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                <span> <b>RouteServiceProvider.php</b> File Permission</span>

                @php
                $phpVersion = number_format((float) phpversion(), 2, '.', '');
                @endphp
                @if ($permission['routes_file_write_perm'])
                <i class="fas fa-check"></i>
                @else
                <i class="fas fa-times"></i>
                @endif
            </li>
        </ul>

        <p>
            <a href="{{ route('installation.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i>
                Previous</a>
            @if (
            $permission['curl_enabled'] == 1 &&
            $permission['file_put_contents'] == 1 &&
            $permission['file_get_contents'] == 1 &&
            $permission['db_file_write_perm'] == 1 &&
            $permission['routes_file_write_perm'] == 1 &&
            $phpVersion >= 8.1)
            <a href="{{ route('installation.dbSetup') }}" class="btn btn-primary">Next <i
                    class="fas fa-arrow-right"></i></a>
            @endif
        </p>
    </div>
</div>
@endsection