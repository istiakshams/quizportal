<!-- Create Choice Modal -->
<div class="modal fade" id="addChoiceModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Add Choice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addChoiceForm" name="addChoiceForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="poll_id" id="pollId">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Choice</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Choice"
                                    value="" maxlength="256" required>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="votes">Votes</label>
                                <input type="number" name="votes" class="form-control" id="votes"
                                    placeholder="Enter Votes" value="0" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-flat btn-primary" id="saveChoice">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>