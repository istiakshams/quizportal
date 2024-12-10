<div class="offcanvas offcanvas-bottom modal" id="offcanvasBottom" tabindex="-1">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Media Files</h5>
        <button class="btn-close" type="button" data-dismiss="modal"></button>
    </div>
    <div class="offcanvas-body bg-secondary-subtle" data-simplebar>

        <!-- content -->
        @include('backend.mediamanager.partials.media-manager-content')
        <!-- content -->

        <div class="d-grid g-3 qp-media-select">
            <button class="btn btn-primary" onclick="showSelectedFilePreview()" data-dismiss="modal">Select</button>
        </div>

    </div>
</div>