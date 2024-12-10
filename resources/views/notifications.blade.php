@if( $errors->any() )
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-ban"></i> Error!</h4>

  <ul>
    @foreach( $errors->all() as $error )

    <li>{{ $error }}</li>

    @endforeach
  </ul>
</div>
@endif

@if( session()->has('message') OR session()->has('status') )
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-check"></i> Success!</h4>
  {{ session()->get('message') }}
  {{ session()->get('status') }}
</div>
@endif

@if( session()->has('error') )
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-ban"></i> Error!</h4>
  {{ session()->get('error') }}
</div>
@endif