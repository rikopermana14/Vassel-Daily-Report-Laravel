<!-- Edit Modal -->
<div class="modal fade" id="edit_modal_consumption" tabindex="-1" role="dialog" aria-labelledby="edit_modal_consumptionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_consumptionLabel">Edit Running Hours Machine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing daily activity -->
                <form id="editconsumptionForm">
                    <input type="hidden" name="edit_id_consumption" id="edit_id_consumption"> <!-- Hidden input for the ID -->
                    <div class="form-group">
                        <label for="edit_date_consumption">Date</label>
                        <input type="date" class="input-group date" name="edit_date_consumption" id="edit_date_consumption" format='YYYY/MM/DD '>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="edit_machine">Machine</label>
                            <select class="form-control"name="edit_machine_consumption" id="edit_machine_consumption" >
                          <option>A/E 1</option>
                          <option>A/E 2</option>
                          <option>M/E 1</option>                      
                          <option>M/E 2</option>
                        </select>
                          </div>
                        </div>
                       </div>
       
                       <div class="row">
                         <div class="col-sm-6">
                           <div class="form-group">
                             <label>Product Code</label>
                             <input type="text" name="edit_code_product" id="edit_code_product" class="form-control" >
                           </div>
                         </div>
                       </div>
                     
                       <div class="row">
                         <div class="col-sm-6">
                           <div class="form-group">
                             <label>Product Name</label>
                             <input type="text" class="form-control" name="edit_name_product" id="edit_name_product">
                           </div>
                         </div>
                       </div>
                        
                        <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" row="5" name="edit_description_consumption" id="edit_description_consumption" ></textarea>
                          </div>
                        </div>
                       </div>
       
                       <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>Used</label>
                        <input type="text" name="edit_used" id="edit_used" class="form-control">
                        </div>
                        </div>
                      </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-Edit-consumption">Save Changes</button>
            </div>
        </div>
    </div>
    </div>
