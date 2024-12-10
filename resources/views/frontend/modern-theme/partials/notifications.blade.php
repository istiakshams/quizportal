@if( $errors->any() )
    <div class="error-wrap">
        <h2><i class="icon fa fa-ban"></i> Error!</h2>
        <ul>
            @foreach( $errors->all() as $error )        
                <li>{{ $error }}</li>            
            @endforeach
        </ul>
    </div>
@endif

@if( session()->has('message') OR session()->has('status') )
  <div class="success-wrap">
    <h2><i class="icon fa fa-check"></i> Success!</h2>
    {{ session()->get('message') }}
    {{ session()->get('status') }}
  </div>
@endif

