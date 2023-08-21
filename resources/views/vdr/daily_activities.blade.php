<div class="card-body">
                    <div class="row">
                   <div class="col-sm-6">
                   <div class="form-group">
                     <label>Date</label>
                     <div class="input-group date" id="daily_date" data-target-input="nearest">
                      <input name="daily_date" id="daily_date_input" type="text" class="form-control datetimepicker-input" data-target="#daily_date"/>
                      <div class="input-group-append" data-target="#daily_date" data-toggle="datetimepicker">
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
                     <label>Time From</label>
                   <input type="time" name="time_from" id="time_from" class="form-control">
                   </div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col-sm-6">
                   <div class="form-group">
                     <label>Time To</label>
                   <input type="time" name="time_to" id="time_to" class="form-control">
                   </div>
                   </div>
                 </div>

                  <div class="row">
                   <div class="col-sm-6">
                     <div class="form-group">
                       <label>Description</label>
                       <textarea class="form-control" row="15" name="description" id="description"></textarea>
                     </div>
                   </div>
                  </div>   
                  <button id="adddaily" class="btn btn-primary">Add</button>

                <div class="row">
                  <div class="table-responsive">
                    <table id="tabledaily" class="display table table-hover" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time From</th>
                                <th>Time To</th>
                                <th>Description</th>
                         
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                           <tbody id="show_data">
                                            </tbody>
                           
                           
                     
                    </table>
                </div>            
                </div>
                </div>
                
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Daily Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete this daily activity?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm-Delete">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                


                <script>
                  $(document).ready(function() {
                    let id_user = {{auth()->user()->id}};
                    let idToDelete; // Deklarasi variabel di sini
          
                      getdaily(); 
                      {{--  $('#tabledaily').dataTable();  --}}
          
                      //fungsi tampil barang
                      function getdaily() {
                          $.ajax({
                              type: 'GET',
                              url: '{{ route('dailyactivities.ajaxdaily') }}',
                         
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
                                       <td>` + data.details[i].time_from + `</td> 
                                       <td>` + data.details[i].time_to + `</td> 
                                       <td>` + data.details[i].description + `</td> 
                                     
                                       <td class="text-center">
                                          <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#editModal1" data="` +
                                          data.details[i].id +
                                          `">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                          </button>
                                          <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#deleteModal" data="` + 
                                          data.details[i].id + `">
                                        <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                      </td>
                                    </tr>
                                    `;
                                  }
                                  html += `
                                
          
                                  `
                                  $('#show_data').html(html);
                              }
                          });
                      }
                      
             
          
          
          //ADD Daily
                      $('#adddaily').on('click', function() {
                            var formData = new FormData();
                          formData.append('_method', $('#_methodAdd').val());
                          formData.append('_token', $('#_tokenAdd').val());
                          formData.append('_enctype', $('#_enctype').val());
                          formData.append('date', $('#daily_date_input').val());
                          formData.append('time_from', $('#time_from').val());
                          formData.append('time_to', $('#time_to').val());
                          formData.append('description', $('#description').val());
                          formData.append('user_input', $('#user_input').val());
                          
          
                          $.ajax({
                             type: 'POST',
                              url: '{{ route('dailyactivities.adddaily') }}',
                              processData: false,
                              contentType: false,
                              data: formData,
                              success: function(data) {
                                  {{--  console.log(data);  --}}
                                  //$('#addBaggageModal').modal('hide');
                                  getdaily();
                              }
                          });
                          
                          return false;
                      });


                      //untuk dellete 
                      function deleteDailyActivity(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('dailyactivities.deletedaily') }}', // Ubah URL sesuai dengan rute Anda
                data: {
                    _token: $('#_tokenAdd').val(),
                    id: id
                },
                success: function(data) {
                    $('#deleteModal').modal('hide');
                    getdaily();
                }
            });
        }

        $('#tabledaily').on('click', '.baggage_hapus', function() {
            idToDelete = $(this).attr('data');
            $('#deleteModal').modal('show');
        });

        $('#confirm-Delete').on('click', function() {
            if (idToDelete) {
                deleteDailyActivity(idToDelete);
                idToDelete = null;
            }
        });

                      // Function to delete a daily activity
});
</script>          


 
