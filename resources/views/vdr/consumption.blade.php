<div class="card-body">
                    <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">

                    {{-- Notifikasi --}}
                    <div class="alert alert-success" id="successMessagecom" style="display: none;">
                      Comsumption added successfully.
                  </div>
                  {{-- end Notifikas --}}

                     <label>Date</label>
                     <div class="input-group date" id="comsumption_date" data-target-input="nearest">
                      <input name="comsumption_date" id="comsumption_date_input" type="text" class="form-control datetimepicker-input" data-target="#comsumption_date"/>
                      <div class="input-group-append" data-target="#comsumption_date" data-toggle="datetimepicker">
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
                     <select class="form-control"name="machine_consumption" id="machine_consumption" >
                      <option>A/E 1</option>
                      <option>A/E 2</option>
                      <option>M/E 1</option>                      
                      <option>M/E 2</option>
                      <option>GB 1</option>                      
                      <option>GB 2</option>
                      <option>Emergency Genset 2</option>
                 </select>
                   </div>
                 </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Code</label>
                      <input type="text" name="code_product" id="code_product" class="form-control">
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" name="name_product" id="name_product">
                    </div>
                  </div>
                </div>
                 
                 <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label>Description</label>
                     <textarea class="form-control" row="15" name="description_consumption" id="description_consumption" ></textarea>
                   </div>
                 </div>
                </div>

                <div class="row">
                 <div class="col-sm-6">
                 <div class="form-group">
                   <label>Used</label>
                 <input type="text" name="used" id="used" class="form-control">
                 </div>
                 </div>
               </div>

               {{-- <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const productCodeSelect = document.getElementById("code_product");
                  const productNameInput = document.getElementById("name_product");
                  const productsData = {!! json_encode($data1) !!}; // Memasukkan data produk dari PHP ke JavaScript
                  
                  const productCodeSelectedit = document.getElementById("edit_code_product");
                  const productNameInputedit = document.getElementById("edit_name_product");
                  const productsDataedit = {!! json_encode($data1) !!}; // Memasukkan data produk dari PHP ke JavaScript
              

                  productNameInput.addEventListener("change", function () {
                    console.log("Script executed");
                    const selectedProductName = productNameInput.value;
                    const selectedProduct = productsData.find(product => product.name === selectedProductName);

                    if (selectedProduct) {
                      productCodeSelect.value = selectedProduct.product_id;
                    } else {
                      productCodeSelect.value = "";
                    }
                  });

                  productNameInputedit.addEventListener("change", function () {
                    console.log("Script executed");
                    const selectedProductNameedit = productNameInputedit.value;
                    const selectedProductedit = productsDataedit.find(product => product.name === selectedProductNameedit);

                    if (selectedProductedit) {
                      productCodeSelectedit.value = selectedProductedit.product_id;
                    } else {
                      productCodeSelectedit.value = "";
                    }
                  });
                });
              </script> --}}
              

               <button id="addconsumption" class="btn btn-primary">Add</button>

               <div class="row">
                <div class="table-responsive">

                  {{-- Notifikasi --}}
                  <div class="alert alert-success" id="successMessagecomedit" style="display: none;">
                    Comsumption edited successfully.
                </div>
                <div class="alert alert-success" id="successMessagecomdel" style="display: none;">
                  Comsumption delete successfully.
              </div>
              {{-- End Notifikasi --}}

                  <table id="tableconsumption" class="display table table-hover" >
                      <thead>
                          <tr>
                              <th>Date</th>
                              <th>Machine</th>
                              <th>Product Code</th>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Used</th>
                       
                              <th style="width: 10%">Action</th>
                          </tr>
                      </thead>
                         <tbody id="show_consumption">
                                          </tbody>
                         
                         
                   
                  </table>
              </div>
            </div>
          </div>

               <!-- /.tab-pane -->
               <!-- Delete Modal -->
               <div class="modal fade" id="delete_modal_consumption" tabindex="-1" role="dialog" aria-labelledby="delete_modal_consumptionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="delete_modal_consumptionLabel">Delete Consumption</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this Consumption?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger" id="confirm_delete_consumption">Delete</button>
                    </div>
                  </div>
                </div>
              </div>

              @include('vdr.modal_edit.modal_consumption')

               <script>
                $(document).ready(function() {
                    let id_user = {{auth()->user()->id}};
                    let idToDelete;
                    
        
                    getconsumption(); 
                    {{--  $('#tableconsumption').dataTable();  --}}
        
                    //fungsi tampil barang
                    function getconsumption() {
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('consumption.ajaxconsumption') }}',
                       
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
                                     <td>` + data.details[i].code_product + `</td> 
                                     <td>` + data.details[i].name_product + `</td> 
                                     <td>` + data.details[i].description + `</td> 
                                     <td>` + data.details[i].used + `</td> 
                                   
                                     <td class="text-center">
                                        <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#edit_modal_consumption" data="` +
                                        data.details[i].id +
                                        `">
                                          <i class="fa fa-edit"></i>
                                          Edit
                                        </button>
                                        <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#delete_modal_consumption" data="` + 
                                          data.details[i].id + `">
                                        <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </td>
                                  </tr>
                                  `;
                                }
                                html += `
                              
        
                                `
                                $('#show_consumption').html(html);
                            }
                        });
                    }
                    
           
        
        
        //ADD Baggage
                    $('#addconsumption').on('click', function() {
                          var formData = new FormData();
                        formData.append('_method', $('#_methodAdd').val());
                        formData.append('_token', $('#_tokenAdd').val());
                        formData.append('_enctype', $('#_enctype').val());
                        formData.append('date', $('#comsumption_date_input').val());
                        formData.append('machine', $('#machine_consumption').val());
                        formData.append('code_product', $('#code_product').val());
                        formData.append('name_product', $('#name_product').val());
                        formData.append('description', $('#description_consumption').val());
                        formData.append('used', $('#used').val());
                        formData.append('user_input', $('#user_input').val());
                        
        
                        $.ajax({
                           type: 'POST',
                            url: '{{ route('consumption.addconsumption') }}',
                            processData: false,
                            contentType: false,
                            data: formData,
                            success: function(data) {
                              // Tampilkan pesan notifikasi
                              $('#successMessagecom').show();

                              // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
                              setTimeout(function() {
                                  $('#successMessagecom').hide();
                              }, 5000);

                                // Bersihkan formulir atau lakukan tindakan lain yang diperlukan
                              $('#comsumption_date_input').val('');
                        $('#machine_consumption').val('');
                        $('#code_product').val('');
                         $('#name_product').val('');
                         $('#description_consumption').val('');
                         $('#used').val('');

                                getconsumption();
                            },
        error: function(xhr, status, error) {
            // Tampilkan pesan notifikasi gagal
            $('#successMessagecom').text('Failed to Add Consumption. Please check the form fields.');
            $('#successMessagecom').removeClass('alert-success').addClass('alert-danger').show();
            setTimeout(function() {
                                  $('#successMessagecom').hide();
                              }, 5000);
        }
                        });
        
                        return false;
                    });

                    //untuk dellete 
                    function deleteconsumption(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('consumption.deleteconsumption') }}', // Ubah URL sesuai dengan rute Anda
                data: {
                    _token: $('#_tokenAdd').val(),
                    id: id
                },
                success: function(data) {
                    $('#delete_modal_consumption').modal('hide');
                     $('#successMessagecomdel').show();

                      // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
                      setTimeout(function() {
                      $('#successMessagecomdel').hide();
                      }, 5000);
                    getconsumption();
                },
        error: function(xhr, status, error) {
            // Tampilkan pesan notifikasi gagal
            $('#successMessagecomdel').text('Failed to Delete Consumption. Please check the form fields.');
            $('#successMessagecomdel').removeClass('alert-success').addClass('alert-danger').show();
            setTimeout(function() {
                                  $('#successMessagecomdel').hide();
                              }, 5000);
        }
            });
        }

        $('#tableconsumption').on('click', '.baggage_hapus', function() {
            idToDelete = $(this).attr('data');
            $('#delete_modal_consumption').modal('show');
        });

        $('#confirm_delete_consumption').on('click', function() {
            if (idToDelete) {
                deleteconsumption(idToDelete);
                idToDelete = null;
            }
        });
                   // Function to edit a Consumption
    function editconsumption(id) {
      var formData = new FormData();
    formData.append('_method', 'PUT'); // Menggunakan metode PUT untuk edit
    formData.append('_token', $('#_tokenAdd').val());
    formData.append('date', $('#edit_date_consumption').val());
    formData.append('machine', $('#edit_machine_consumption').val());
    formData.append('code_product', $('#edit_code_product').val());
    formData.append('name_product', $('#edit_name_product').val());
    formData.append('description', $('#edit_description_consumption').val());
    formData.append('used', $('#edit_used').val());
    formData.append('user_input', $('#user_input').val());

    $.ajax({
        type: 'POST', // Anda juga bisa gunakan method PUT sesuai kebutuhan Anda
        url: '/consumption/' + id, // Ubah URL sesuai dengan rute yang benar
        processData: false,
        contentType: false,
        data: formData,
        success: function(data) {
            $('#edit_modal_consumption').modal('hide');
            $('#successMessagecomedit').show();

            // Sembunyikan pesan notifikasi setelah beberapa detik (jika diperlukan)
            setTimeout(function() {
                $('#successMessagecomedit').hide();
            }, 5000);
            getconsumption();
            },
        error: function(xhr, status, error) {
            // Tampilkan pesan notifikasi gagal
            $('#successMessagecomeditmo').text('Failed to edit Consumption. Please check the form fields.');
            $('#successMessagecomeditmo').removeClass('alert-success').addClass('alert-danger').show();
            setTimeout(function() {
                                  $('#successMessagecomeditmo').hide();
                              }, 5000);
        }
        });
    }

    // Function to populate the edit modal
    function populateEditModal(id) {
        $.ajax({
            type: 'GET',
            url: '/consumption/' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#edit_id').val(data.id);
                $('#edit_date_consumption').val(data.date);
                $('#edit_machine_consumption').val(data.machine);
                $('#edit_code_product').val(data.code_product);
                $('#edit_name_product').val(data.name_product);
                $('#edit_description_consumption').val(data.description);
                $('#edit_used').val(data.used);
            }
        });
    }

    $('#tableconsumption').on('click', '.baggage_edit', function() {
        idToEdit = $(this).attr('data');
        populateEditModal(idToEdit);
        $('#edit_modal_consumption').modal('show');
    });

    $('#confirm-Edit-consumption').on('click', function() {
        if (idToEdit) {
            editconsumption(idToEdit);
            idToEdit = null;
        }
    });
});
</script>      
        

              