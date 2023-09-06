<!-- Edit Modal -->
<div class="modal fade" id="edit_modal_payload" tabindex="-1" role="dialog" aria-labelledby="edit_modal_payloadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_payloadLabel">Edit Running Hours Machine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing daily activity -->
                <form id="editconsumptionForm">
                    <input type="hidden" name="edit_id_payload" id="edit_id_payload"> <!-- Hidden input for the ID -->
                    <div class="form-group">
                        <label for="edit_date_payload">Date</label>
                        <input type="date" class="form-control" name="edit_date_payload" id="edit_date_payload">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Product Name</label>
                        <input type="text" name="edit_product_payload" id="edit_product_payload" class="form-control">
                        </div>
                        </div>
                      </div>
                      
                      
                       <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Previous</label>
                        <input type="text" name="edit_previous_payload" id="edit_previous_payload" class="form-control">
                        </div>
                        </div>
                      </div>
                      
                       <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Received</label>
                        <input type="text" name="edit_received_payload" id="edit_received_payload" class="form-control">
                        </div>
                        </div>
                      </div>
                      
                      
                       <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Transfered</label>
                        <input type="text" name="edit_transfered_payload" id="edit_transfered_payload" class="form-control">
                        </div>
                        </div>
                      </div>
                      
                      
                       <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Remain</label>
                        <input type="text" name="edit_remain" id="edit_remain_payload" class="form-control">
                        </div>
                        </div>
                      </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-Edit-payload">Save Changes</button>
            </div>
        </div>
    </div>
    </div>
