<div class="card-body">
                    <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
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

                <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label>Machine</label>
                     <select class="form-control"name="machine_consumption" id="machine_consumption" >
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
                      <input type="text" name="code_product" id="code_product" class="form-control" readonly>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <select class="form-control" name="name_product" id="name_product">
                        <option value="">-Pilih Product-</option>
                        @foreach ($data as $item)
                          <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
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

               <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const productCodeSelect = document.getElementById("code_product");
                  const productNameInput = document.getElementById("name_product");
                  const productsData = {!! json_encode($data) !!}; // Memasukkan data produk dari PHP ke JavaScript
              
                  productNameInput.addEventListener("change", function () {
                    const selectedProductName = productNameInput.value;
                    const selectedProduct = productsData.find(product => product.name === selectedProductName);
              
                    if (selectedProduct) {
                      productCodeSelect.value = selectedProduct.product_id;
                    } else {
                      productCodeSelect.value = "";
                    }
                  });
                });
              </script>
              

               <button id="addconsumption" class="btn btn-primary">Add</button>

               <div class="row">
                <div class="table-responsive">
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


               <script>
                $(document).ready(function() {
                    let id_user = {{auth()->user()->id}};
                    
        
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
                                        <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#editModal1" data="` +
                                        data.details[i].id +
                                        `">
                                          <i class="fa fa-edit"></i>
                                          Edit
                                        </button>
                                        <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#deleteModal" data="` +
                                        data.details[i].id + `">
                                          <i class="fas fa-trash-alt"></i>
                                          Delete
                                      </div>
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
                                {{--  console.log(data);  --}}
                                //$('#addBaggageModal').modal('hide');
                                getconsumption();
                            }
                        });
        
                        return false;
                    });
                  });
        </script>          
        

              