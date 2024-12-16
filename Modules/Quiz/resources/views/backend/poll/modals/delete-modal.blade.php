<!-- Delete Choice Modal -->
<div class="modal fade" id="deleteChoiceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteChoiceForm" name="deleteChoiceForm" class="form-horizontal">
                <input type="hidden" name="id" id="deleteId">
                <div class="modal-body">
                    Do you really want to delete this choice?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-flat btn-danger" id="deleteChoice">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>