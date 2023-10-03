<!-- Edit Modal -->
<div class="modal fade" id="editModalstock" tabindex="-1" role="dialog" aria-labelledby="editModalstockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalstockLabel">Edit stock Hours Machine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing daily activity -->
                <form id="editstockForm">
                    <input type="hidden" name="edit_idstock" id="edit_idstock"> <!-- Hidden input for the ID -->
                    <div class="form-group">
                        <label for="edit_datestock">Date</label>
                        <input type="date" class="form-control" name="edit_datestock" id="edit_datestock">
                    </div>                   
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Product Code</label>
                    <input type="text" name="edit_product_code" class="form-control" id="edit_productkode" readonly>
                  </div>
                </div>
              </div>
            
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Product Name</label>
                    <select class="form-control" name="edit_product_name" id="edit_productnama">
                      <option value="">-Pilih Product-</option>
                      @foreach ($data1 as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
                
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Spec</label>
                    <textarea class="form-control" name="edit_spec" id="edit_spec" rows="5" readonly></textarea>
                  </div>
                </div>
              </div>
              
              <!-- Add the remaining input fields with proper name attributes -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Previous</label>
                    <input type="text" name="edit_previous"id="edit_previous" class="form-control" readonly>
                  </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Received</label>
                <input type="text" name="edit_received" id="edit_received" class="form-control">
                </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Used</label>
                <input type="text" name="edit_used" id="edit_used1" class="form-control">
                </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Transfered</label>
                <input type="text" name="edit_transfered"id="edit_transfered" class="form-control">
                </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Sounding</label>
                <input type="text" name="edit_sounding"  id="edit_sounding" class="form-control">
                </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                  <label>Remain</label>
                <input type="text" name="edit_remain" id="edit_remain" class="form-control" readonly>
                </div>
                </div>
              </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-Edit-stock">Save Changes</button>
            </div>
        </div>
    </div>
    </div>
</div>
