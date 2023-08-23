<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Daily Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing daily activity -->
                <form id="editForm">
                    <input type="hidden" name="edit_id" id="edit_id"> <!-- Hidden input for the ID -->
                    <div class="form-group">
                        <label for="edit_date">Date</label>
                        <input type="date" class="form-control" name="edit_date" id="edit_date">
                    </div>
                    <div class="form-group">
                        <label for="edit_time_from">Time From</label>
                        <input type="time" class="form-control" name="edit_time_from" id="edit_time_from">
                    </div>
                    <div class="form-group">
                        <label for="edit_time_to">Time To</label>
                        <input type="time" class="form-control" name="edit_time_to" id="edit_time_to">
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" name="edit_description" id="edit_description" rows="5"></textarea>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-Edit">Save Changes</button>
            </div>
        </div>
    </div>
    </div>
