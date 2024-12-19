<div class="modal fade" id="offcanvasBottom" style="padding-right:0 !important;">
    <div class="modal-dialog" style="max-width:100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Media Files</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- content -->
                @include('backend.mediamanager.partials.media-manager-content')
                <!-- content -->

                <div class="media-select-wrap">
                    <button class="btn btn-lg btn-flat btn-primary" onclick="showSelectedFilePreview()"
                        data-dismiss="modal">Select
                        Media</button>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->