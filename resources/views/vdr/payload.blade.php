      <div class="card-body">
        <div class="row">
        <div class="col-sm-6">
          <div class="form-group">

            {{-- Notifikasi --}}
            <div class="alert alert-success" id="successMessagepay" style="display: none;">
              Payload added successfully.
          </div>
          {{-- end Notifikas --}}
          
            <label>Date</label>
            <div class="input-group date" id="payload_date" data-target-input="nearest">
              <input name="payload_date" id="payload_date_input" type="text" class="form-control datetimepicker-input" data-target="#payload_date"/>
              <div class="input-group-append" data-target="#payload_date" data-toggle="datetimepicker">
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
      <input type="text" name="product_payload" id="product_payload" class="form-control">
      </div>
      </div>
    </div>


      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Previous</label>
        <input type="text" name="previous_payload" id="previous_payload" class="form-control">
        </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Received</label>
        <input type="text" name="received_payload" id="received_payload" class="form-control">
        </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Transfered</label>
        <input type="text" name="transfered_payload" id="transfered_payload" class="form-control">
        </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Remain</label>
        <input type="text" name="remain" id="remain_payload" class="form-control">
        </div>
        </div>
      </div>

      <button id="submitpayload" class="btn btn-primary">Add</button>

      <div class="row">
      <div class="table-responsive">

         {{-- Notifikasi --}}
         <div class="alert alert-success" id="successMessagepayedit" style="display: none;">
          Payload edited successfully.
      </div>
      <div class="alert alert-success" id="successMessagepaydel" style="display: none;">
        Payload delete successfully.
    </div>
    {{-- End Notifikasi --}}

        <table id="tablepayload" class="display table table-hover" >
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
                <tbody id="show_payload">
                                </tbody>
                
                
          
        </table>
      </div>
      </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="delete_modal_payload" tabindex="-1" role="dialog" aria-labelledby="delete_modal_payloadLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete_modal_payloadLabel">Delete Payload</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this Payload?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id="confirm_delete_payload">Delete</button>
            </div>
          </div>
        </div>
      </div>

      @include('vdr.modal_edit.modal_payload')


      <script>
        $(document).ready(function() {
            let id_user = {{auth()->user()->id}};
            let idToDelete;

            getpayload(); 
            {{--  $('#tablepayload').dataTable();  --}}

            //fungsi tampil barang
            function getpayload() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('payload.ajaxpayload') }}',
              
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
                                <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#edit_modal_payload" data="` +
                                data.details[i].id +
                                `">
                                  <i class="fa fa-edit"></i>
                                  Edit
                                </button>
                                <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#delete_modal_payload" data="` + 
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
                        $('#show_payload').html(html);
                    }
                });
            }
            



      //ADD Baggage
            $('#submitpayload').on('click', function() {
                  var formData = new FormData();
                formData.append('_method', $('#_methodAdd').val());
                formData.append('_token', $('#_tokenAdd').val());
                formData.append('_enctype', $('#_enctype').val());
                formData.append('date', $('#payload_date_input').val());
                formData.append('product_name', $('#product_payload').val());
                formData.append('previous', $('#previous_payload').val());
                formData.append('receive', $('#received_payload').val());
                formData.append('transfer', $('#transfered_payload').val());
                formData.append('remain', $('#remain_payload').val());
                formData.append('user_input', $('#user_input').val());
                

                $.ajax({
                  type: 'POST',
                    url: '{{ route('payload.addpayloads') }}',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                              // Tampilkan pesan notifikasi
                              $('#successMessagepay').show();

                              // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
                              setTimeout(function() {
                                  $('#successMessagepay').hide();
                              }, 5000);

                                // Bersihkan formulir atau lakukan tindakan lain yang diperlukan
                                
                                $('#product_payload').val('');
                                $('#previous_payload').val('');
                                $('#received_payload').val('');
                                $('#transfered_payload').val('');
                                $('#remain_payload').val('');

                    getpayload();
                    },
        error: function(xhr, status, error) {
            // Tampilkan pesan notifikasi gagal
            $('#successMessagepay').text('Failed to Add Payload. Please check the form fields.');
            $('#successMessagepay').removeClass('alert-success').addClass('alert-danger').show();
            setTimeout(function() {
                                  $('#successMessagepay').hide();
                              }, 5000);
        }
                });

                return false;
            });
            //untuk dellete 
            function deletepayload(id) {
                  $.ajax({
                      type: 'POST',
                      url: '{{ route('payload.deletepayload') }}', // Ubah URL sesuai dengan rute Anda
                      data: {
                          _token: $('#_tokenAdd').val(),
                          id: id
                      },
                      success: function(data) {
                          $('#delete_modal_payload').modal('hide');
                              
                              $('#successMessagepaydel').show();

                              // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
                              setTimeout(function() {
                              $('#successMessagepaydel').hide();
                              }, 5000);

                          getpayload();
                      }
                  });
              }

              $('#tablepayload').on('click', '.baggage_hapus', function() {
                  idToDelete = $(this).attr('data');
                  $('#delete_modal_payload').modal('show');
              });

              $('#confirm_delete_payload').on('click', function() {
                  if (idToDelete) {
                    deletepayload(idToDelete);
                      idToDelete = null;
                  }
              });
            // Function to edit a Payload
            function editpayload(id) {
            var formData = new FormData();
                formData.append('_method', 'PUT'); // Menggunakan metode PUT untuk edit
                formData.append('_token', $('#_tokenAdd').val());
                formData.append('date', $('#edit_date_payload').val());
                formData.append('product_name', $('#edit_product_payload').val());
                formData.append('previous', $('#edit_previous_payload').val());
                formData.append('receive', $('#edit_received_payload').val());
                formData.append('transfer', $('#edit_transfered_payload').val());
                formData.append('remain', $('#edit_remain_payload').val());
                formData.append('user_input', $('#user_input').val());

          $.ajax({
              type: 'POST', // Anda juga bisa gunakan method PUT sesuai kebutuhan Anda
              url: '/payload/' + id, // Ubah URL sesuai dengan rute yang benar
              processData: false,
              contentType: false,
              data: formData,
              success: function(data) {
                  $('#edit_modal_payload').modal('hide');
                    $('#successMessagepayedit').show();

                    // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
                    setTimeout(function() {
                        $('#successMessagepayedit').hide();
                    }, 5000);

                  getpayload();
                  },
        error: function(xhr, status, error) {
            // Tampilkan pesan notifikasi gagal
            $('#successMessagepayeditmo').text('Failed to edit Payload. Please check the form fields.');
            $('#successMessagepayeditmo').removeClass('alert-success').addClass('alert-danger').show();
            setTimeout(function() {
                                  $('#successMessagepyeditmo').hide();
                              }, 5000);
        }
              });
          }

          // Function to populate the edit modal
          function populateEditModal(id) {
              $.ajax({
                  type: 'GET',
                  url: '/payload/' + id,
                  async: true,
                  dataType: 'json',
                  success: function(data) {
                      $('#edit_id').val(data.id);
                      $('#edit_date_payload').val(data.date);
                      $('#edit_product_payload').val(data.product_name);
                      $('#edit_previous_payload').val(data.previous);
                      $('#edit_received_payload').val(data.receive);
                      $('#edit_transfered_payload').val(data.transfer);
                      $('#edit_remain_payload').val(data.remain);
                  }
              });
          }

          $('#tablepayload').on('click', '.baggage_edit', function() {
              idToEdit = $(this).attr('data');
              populateEditModal(idToEdit);
              $('#edit_modal_payload').modal('show');
          });

          $('#confirm-Edit-payload').on('click', function() {
              if (idToEdit) {
                  editpayload(idToEdit);
                  idToEdit = null;
              }
          });
      });
      </script>          