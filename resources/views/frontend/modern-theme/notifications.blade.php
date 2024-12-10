@if( $errors->any() )
<div class="qp-notification qp-error">
  <ul>
    @foreach( $errors->all() as $error )
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if( session()->has('message') OR session()->has('status') )
<div class="qp-notification qp-success">
  {{ session()->get('message') }}
  {{ session()->get('status') }}
</div>
@endif

@if( session()->has('error') )
<div class="qp-notification qp-error">
  {{ session()->get('error') }}
</div>
@endif