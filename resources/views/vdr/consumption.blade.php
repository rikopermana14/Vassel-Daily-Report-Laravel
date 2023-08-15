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
                     <select class="form-control"name="machine" >
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
                      <input type="text" name="product_code" class="form-control" id="productCodeSelect" readonly>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <select class="form-control" name="product_name" id="productNameInput">
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
                     <textarea class="form-control" row="15" name="description" ></textarea>
                   </div>
                 </div>
                </div>

                <div class="row">
                 <div class="col-sm-6">
                 <div class="form-group">
                   <label>Used</label>
                 <input type="text" name="used" class="form-control">
                 </div>
                 </div>
               </div>

               <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const productCodeSelect = document.getElementById("productCodeSelect");
                  const productNameInput = document.getElementById("productNameInput");
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
              

               </div>
               <!-- /.tab-pane -->

               

