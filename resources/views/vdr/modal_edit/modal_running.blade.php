<!-- Edit Modal -->
<div class="modal fade" id="editModalrunning" tabindex="-1" role="dialog" aria-labelledby="editModalrunningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalrunningLabel">Edit Running Hours Machine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="successMessageruneditmo" style="display: none;">
                    Daily activity edited successfully.
                </div>
                <!-- Form for editing daily activity -->
                <form id="editrunningForm">
                    <input type="hidden" name="edit_idrunning" id="edit_idrunning"> <!-- Hidden input for the ID -->
                    <div class="form-group">
                        <label for="edit_daterunning">Date</label>
                        <input type="date" class="form-control" name="edit_daterunning" id="edit_daterunning">
                    </div>
                    <div class="form-group">
                        <label for="edit_machine">Machine</label>
                        <select class="form-control"name="edit_machine" id="edit_machine">
                            <option>A/E 1</option>
                      <option>A/E 2</option>
                      <option>M/E 1</option>                      
                      <option>M/E 2</option>
                      <option>GB 1</option>                      
                      <option>GB 2</option>
                      <option>Emergency Genset 2</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_towing">Run Hours Towing</label>
                        <input type="time" class="form-control" name="edit_towing" id="edit_towing">
                    </div>
                    <div class="form-group">
                        <label for="edit_manouver">Run Hours Manouver</label>
                        <input type="time" class="form-control" name="edit_manouver" id="edit_manouver" >
                    </div>
                    <div class="form-group">
                        <label for="edit_slow">Run Hours Slow</label>
                        <input type="time" class="form-control" name="edit_slow" id="edit_slow" >
                    </div>
                    <div class="form-group">
                        <label for="edit_economi">Run Hours Economi</label>
                        <input type="time" class="form-control" name="edit_economi" id="edit_economi" >
                    </div>
                    <div class="form-group">
                        <label for="edit_full_speed">Run Hours Full Speed</label>
                        <input type="time" class="form-control" name="edit_full_speed" id="edit_full_speed" >
                    </div>
                    <div class="form-group">
                        <label for="edit_standby">Run Hours Stand BY</label>
                        <input type="time" class="form-control" name="edit_standby" id="edit_standby" >
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-Edit-running">Save Changes</button>
            </div>
        </div>
    </div>
    </div>
