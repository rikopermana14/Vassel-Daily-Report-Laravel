<div class="card-body">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Date</label>
      <div class="input-group date" id="muatan_date" data-target-input="nearest">
        <input name="muatan_date" id="muatan_date_input" type="text" class="form-control datetimepicker-input" data-target="#muatan_date"/>
        <div class="input-group-append" data-target="#muatan_date" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
      </div>
    </div>
    </div>
  </div>
</div>

                  <input type="hidden" name="_methodAdd" id="_methodAdd" value="POST">
                 <input type="hidden" name="_enctype" id="_enctype" value="multipart/form-data">
                 <input type="hidden" name="_tokenAdd" id="_tokenAdd" value="{{ csrf_token() }}">
                 <input type="hidden" name="user_input" id="user_input" value="{{auth()->user()->id}}">

 <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    <label>Product Name</label>
  <input type="text" name="product_muatan" id="product_muatan" class="form-control">
  </div>
  </div>
</div>


 <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    <label>Previous</label>
  <input type="text" name="previous_muatan" id="previous_muatan" class="form-control">
  </div>
  </div>
</div>

 <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    <label>Received</label>
  <input type="text" name="received_muatan" id="received_muatan" class="form-control">
  </div>
  </div>
</div>


 <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    <label>Transfered</label>
  <input type="text" name="transfered_muatan" id="transfered_muatan" class="form-control">
  </div>
  </div>
</div>


 <div class="row">
  <div class="col-sm-6">
  <div class="form-group">
    <label>Remain</label>
  <input type="text" name="remain" id="remain_muatan" class="form-control">
  </div>
  </div>
</div>

<button id="submitmuatan" class="btn btn-primary">Add</button>

<div class="row">
 <div class="table-responsive">
   <table id="tablemuatan" class="display table table-hover" >
       <thead>
           <tr>
               <th>Date</th>
               <th>Product Name</th>
               <th>Previous</th>
               <th>Received</th>
               <th>Transfered</th>
               <th>Remain</th>
        
               <th style="width: 10%">Action</th>
           </tr>
       </thead>
          <tbody id="show_muatan">
                           </tbody>
          
          
    
   </table>
</div>
</div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal_muatan" tabindex="-1" role="dialog" aria-labelledby="delete_modal_muatanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_modal_muatanLabel">Delete Daily Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this daily activity?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm_delete_muatan">Delete</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
      let id_user = {{auth()->user()->id}};
      let idToDelete;

      getmuatan(); 
      {{--  $('#tablemuatan').dataTable();  --}}

      //fungsi tampil barang
      function getmuatan() {
          $.ajax({
              type: 'GET',
              url: '{{ route('muatan.ajaxmuatan') }}',
         
              async: true,
              dataType: 'json',
              success: function(data) {
                  {{--  console.log(data.details.length);  --}}
                  

                  var html = '';
                  var i;

                  for (i = 0; i < data.details.length; i++) {

                      html += `
                    <tr>
                       <td>` + data.details[i].date + `</td> 
                       <td>` + data.details[i].product_name + `</td> 
                       <td>` + data.details[i].previous + `</td> 
                       <td>` + data.details[i].receive + `</td> 
                       <td>` + data.details[i].transfer + `</td> 
                       <td>` + data.details[i].remain + `</td> 
                     
                       <td class="text-center">
                          <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#editModal1" data="` +
                          data.details[i].id +
                          `">
                            <i class="fa fa-edit"></i>
                            Edit
                          </button>
                          <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#delete_modal_muatan" data="` + 
                                          data.details[i].id + `">
                                        <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                        </div>
                      </td>
                    </tr>
                    `;
                  }
                  html += `
                

                  `
                  $('#show_muatan').html(html);
              }
          });
      }
      



//ADD Baggage
      $('#submitmuatan').on('click', function() {
            var formData = new FormData();
          formData.append('_method', $('#_methodAdd').val());
          formData.append('_token', $('#_tokenAdd').val());
          formData.append('_enctype', $('#_enctype').val());
          formData.append('date', $('#muatan_date_input').val());
          formData.append('product_name', $('#product_muatan').val());
          formData.append('previous', $('#previous_muatan').val());
          formData.append('receive', $('#received_muatan').val());
          formData.append('transfer', $('#transfered_muatan').val());
          formData.append('remain', $('#remain_muatan').val());
          formData.append('user_input', $('#user_input').val());
          

          $.ajax({
             type: 'POST',
              url: '{{ route('muatan.addmuatans') }}',
              processData: false,
              contentType: false,
              data: formData,
              success: function(data) {
                  {{--  console.log(data);  --}}
                  //$('#addBaggageModal').modal('hide');
                  getmuatan();
              }
          });

          return false;
      });
      //untuk dellete 
      function deletemuatan(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('muatan.deletemuatan') }}', // Ubah URL sesuai dengan rute Anda
                data: {
                    _token: $('#_tokenAdd').val(),
                    id: id
                },
                success: function(data) {
                    $('#delete_modal_muatan').modal('hide');
                    getmuatan();
                }
            });
        }

        $('#tablemuatan').on('click', '.baggage_hapus', function() {
            idToDelete = $(this).attr('data');
            $('#delete_modal_muatan').modal('show');
        });

        $('#confirm_delete_muatan').on('click', function() {
            if (idToDelete) {
              deletemuatan(idToDelete);
                idToDelete = null;
            }
        });
    });
</script>          