<div class="form-group">
    <input type="hidden" name="types[]" value="{{ $value }}">
    <div class="qp-image-drop rounded">
        <!-- choose media -->
        <div class="qp-featured-image show-selected-files">
            <div class="show-image-preview" data-toggle="offcanvas" data-target="#offcanvasBottom"
                onclick="showMediaManager(this)" data-selection="single">
                <input type="hidden" name="{{ $value }}" value="{{ $image }}">
                @if( $image == null )
                <div class="qp-icon-btn media-add-btn rounded-circle">
                    <i class="fas fa-plus"></i>
                </div>
                @endif
            </div>
        </div>
        <!-- choose media -->
    </div>
</div>