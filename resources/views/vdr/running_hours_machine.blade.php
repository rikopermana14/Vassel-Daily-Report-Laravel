<div class="card-body">
        <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
             <label>Date</label>
             <div class="input-group date" id="running_hours_date" data-target-input="nearest">
              <input name="running_hours_date" id="running_hours_date_input" type="text" class="form-control datetimepicker-input" data-target="#running_hours_date"/>
              <div class="input-group-append" data-target="#running_hours_date" data-toggle="datetimepicker">
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
             <label>Machine</label>
             <select class="form-control"name="machine" id="machine">
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
           <label>Run Hours Towing</label>
         <input type="text" name="towing" id="towing" class="form-control">
         </div>
         </div>
       </div>

        <div class="row">
         <div class="col-sm-6">
         <div class="form-group">
           <label>Run Hours Manouver</label>
         <input type="text" name="manouver" id="manouver" class="form-control">
         </div>
         </div>
       </div>

        <div class="row">
         <div class="col-sm-6">
         <div class="form-group">
           <label>Run Hours Slow</label>
         <input type="text" name="slow" id="slow" class="form-control">
         </div>
         </div>
       </div> 

        <div class="row">
         <div class="col-sm-6">
         <div class="form-group">
           <label>Run Hours Economi</label>
         <input type="text" name="economi" id="economi" class="form-control">
         </div>
         </div>
       </div>

         <div class="row">
         <div class="col-sm-6">
         <div class="form-group">
           <label>Run Hours Full Speed</label>
         <input type="text" name="full_speed" id="full_speed" class="form-control">
         </div>
         </div>
       </div>

         <div class="row">
         <div class="col-sm-6">
         <div class="form-group">
           <label>Run Hours Stand By</label>
         <input type="text" name="standby" id="standby" class="form-control">
         </div>
         </div>
       </div>

       <button id="addrunning" class="btn btn-primary">Add</button>

       <div class="row">
        <div class="table-responsive">
          <table id="tablerunning" class="display table table-hover" >
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Machine</th>
                      <th>Run Hours Towing</th>
                      <th>Run Hours Manouver</th>
                      <th>Run Hours Slow</th>
                      <th>Run Hours Economi</th>
                      <th>Run Hours Full Speed</th>
                      <th>Run Hours Stand By</th>
               
                      <th style="width: 10%">Action</th>
                  </tr>
              </thead>
                 <tbody id="show_running">
                                  </tbody>
                 
                 
           
          </table>
      </div>
    </div>
  </div>

   <!-- Delete Modal -->
   <div class="modal fade" id="delete_modal_running" tabindex="-1" role="dialog" aria-labelledby="delete_modal_runningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delete_modal_runningLabel">Delete Running Hours</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this Running Hours?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirm_delete_running">Delete</button>
        </div>
      </div>
    </div>
  </div>

                  {{-- Modal Edit --}}
                  @include('vdr.modal_edit.modal_running')

      <script>
        $(document).ready(function() {
            let id_user = {{auth()->user()->id}};
            let idToDelete;
            

            getrunning(); 
            {{--  $('#tablerunning').dataTable();  --}}

            //fungsi tampil barang
            function getrunning() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('running.ajaxrunning') }}',
               
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
                             <td>` + data.details[i].machine + `</td> 
                             <td>` + data.details[i].towing + `</td> 
                             <td>` + data.details[i].manouver + `</td> 
                             <td>` + data.details[i].slow + `</td> 
                             <td>` + data.details[i].economi + `</td> 
                             <td>` + data.details[i].full_speed + `</td> 
                             <td>` + data.details[i].standby + `</td> 
                           
                             <td class="text-center">
                                <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#editModalrunning" data="` +
                                data.details[i].id +
                                `">
                                  <i class="fa fa-edit"></i>
                                  Edit
                                </button>
                                <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#delete_modal_running" data="` + 
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
                        $('#show_running').html(html);
                    }
                });
            }
            
   


//ADD Baggage
            $('#addrunning').on('click', function() {
                  var formData = new FormData();
                formData.append('_method', $('#_methodAdd').val());
                formData.append('_token', $('#_tokenAdd').val());
                formData.append('_enctype', $('#_enctype').val());
                formData.append('date', $('#running_hours_date_input').val());
                formData.append('machine', $('#machine').val());
                formData.append('towing', $('#towing').val());
                formData.append('manouver', $('#manouver').val());
                formData.append('slow', $('#slow').val());
                formData.append('economi', $('#economi').val());
                formData.append('full_speed', $('#full_speed').val());
                formData.append('standby', $('#standby').val());
                formData.append('user_input', $('#user_input').val());
                

                $.ajax({
                   type: 'POST',
                    url: '{{ route('running.addrunning') }}',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        {{--  console.log(data);  --}}
                        //$('#addBaggageModal').modal('hide');
                        getrunning();
                    }
                });

                return false;
            });
            
            //untuk dellete 
            function deleterunning(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('running.deleterunning') }}', // Ubah URL sesuai dengan rute Anda
                data: {
                    _token: $('#_tokenAdd').val(),
                    id: id
                },
                success: function(data) {
                    $('#delete_modal_running').modal('hide');
                    getrunning();
                }
            });
        }

        $('#tablerunning').on('click', '.baggage_hapus', function() {
            idToDelete = $(this).attr('data');
            $('#delete_modal_running').modal('show');
        });

        $('#confirm_delete_running').on('click', function() {
            if (idToDelete) {
              deleterunning(idToDelete);
                idToDelete = null;
            }
        });
                   // Function to edit a daily activity
    function editrunning(id) {
      var formData = new FormData();
    formData.append('_method', 'PUT'); // Menggunakan metode PUT untuk edit
    formData.append('_token', $('#_tokenAdd').val());
    formData.append('date', $('#edit_daterunning').val());
    formData.append('machine', $('#edit_machine').val());
    formData.append('towing', $('#edit_towing').val());
    formData.append('manouver', $('#edit_manouver').val());
    formData.append('slow', $('#edit_slow').val());
    formData.append('economi', $('#edit_economi').val());
    formData.append('full_speed', $('#edit_full_speed').val());
    formData.append('standby', $('#edit_standby').val());
    formData.append('user_input', $('#user_input').val());

    $.ajax({
        type: 'POST', // Anda juga bisa gunakan method PUT sesuai kebutuhan Anda
        url: '/running/' + id, // Ubah URL sesuai dengan rute yang benar
        processData: false,
        contentType: false,
        data: formData,
        success: function(data) {
            $('#editModalrunning').modal('hide');
            getrunning();
            }
        });
    }

    // Function to populate the edit modal
    function populateEditModal(id) {
        $.ajax({
            type: 'GET',
            url: '/running/' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#edit_id').val(data.id);
                $('#edit_daterunning').val(data.date);
                $('#edit_machine').val(data.machine);
                $('#edit_towing').val(data.towing);
                $('#edit_manouver').val(data.manouver);
                $('#edit_slow').val(data.slow);
                $('#edit_economi').val(data.economi);
                $('#edit_full_speed').val(data.full_speed);
                $('#edit_standby').val(data.standby);
            }
        });
    }

    $('#tablerunning').on('click', '.baggage_edit', function() {
        idToEdit = $(this).attr('data');
        populateEditModal(idToEdit);
        $('#editModalrunning').modal('show');
    });

    $('#confirm-Edit-running').on('click', function() {
        if (idToEdit) {
            editrunning(idToEdit);
            idToEdit = null;
        }
    });
});
</script> 



