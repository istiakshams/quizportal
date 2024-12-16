<!-- Edit Choice Modal -->
<div class="modal fade" id="editChoiceModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Edit Choice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editChoiceForm" name="editChoiceForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <input type="hidden" name="poll_id" id="editPollId">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Choice</label>
                                <input type="text" name="name" class="form-control" id="editName"
                                    placeholder="Enter Choice" value="" maxlength="256" required>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="votes">Votes</label>
                                <input type="number" name="votes" class="form-control" id="editVotes"
                                    placeholder="Enter Votes" value="" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-flat btn-primary" id="updateChoice">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>