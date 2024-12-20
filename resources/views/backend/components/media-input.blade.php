<div class="form-group">
    @if( isset($label) )
    <label for="{{ $value }}">{{ $label }}</label>
    @endif
    <input type="hidden" name="types[]" value="{{ $value }}">
    <div class="qp-image-drop rounded">
        <!-- choose media -->
        <div class="qp-featured-image show-selected-files">
            <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                onclick="showMediaManager(this)" data-selection="single">
                @if( $image == null )
                <div class="qp-icon-btn media-add-btn rounded-circle">
                    <i class="fas fa-plus"></i>
                </div>
                @endif
            </div>
            <input type="hidden" class="image_id" name="{{ $value }}" value="{{ $image }}">
        </div>
        <!-- choose media -->
    </div>
</div>