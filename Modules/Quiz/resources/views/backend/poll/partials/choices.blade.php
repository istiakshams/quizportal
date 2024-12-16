@foreach( $choices as $choice )
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="choices">Choice {{ $loop->iteration }}</label>
            <p style="border:1px solid #ced4da;padding:5px 10px;border-radius:.25rem;">{{
                $choice->name }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="votes">Votes</label>
            <p style="border:1px solid #ced4da;padding:5px 10px;border-radius:.25rem;">{{
                $choice->votes }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="editChoice">&nbsp;</label>
            <a href="javascript:void(0)" data-id="{{ $choice->id }}" class="btn btn-block btn-flat btn-primary"
                id="editChoice"><i class="far fa-edit"></i>
                Edit</a>
        </div>
    </div>
    <div class="col-md-2">
        <label for="editChoice">&nbsp;</label>
        <a href="javascript:void(0)" data-id="{{ $choice->id }}" class="btn btn-block btn-flat btn-danger"
            id="showDeleteModal"><i class="far fa-trash-alt"></i>
            Delete</a>
    </div>
</div>
@endforeach
<a href="javascript:void(0)" data-pollid="{{ $choice->poll_id }}" class=" btn btn-flat btn-primary" id="addChoice"><i
        class="fas fa-plus"></i> Add New</a>