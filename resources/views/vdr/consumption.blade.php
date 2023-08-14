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
                      <select class="form-control"name="product_code" id="productCodeSelect">
                        <option value="">-Pilih Kode Product-</option>
                        @foreach ($data as $item)
                    <option value="{{ $item->product_id }}">{{ $item->product_id }}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
                 </div>

                 <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" name="product_name" class="form-control" id="productNameInput" readonly>
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
        
                    productCodeSelect.addEventListener("change", function () {
                        const selectedProductCode = productCodeSelect.value;
                        const selectedProduct = productsData.find(product => product.product_id === selectedProductCode);
        
                        if (selectedProduct) {
                            productNameInput.value = selectedProduct.name;
                        } else {
                            productNameInput.value = "";
                        }
                    });
                });
            </script>

               </div>
               <!-- /.tab-pane -->

               <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const productCodeSelect = document.getElementById("productCodeSelect");
              
                  productCodeSelect.addEventListener("change", function () {
                    const selectedProductCode = productCodeSelect.value;
                    // Di sini, Anda dapat menambahkan logika pencarian sesuai dengan kebutuhan Anda.
                    // Misalnya, mungkin Anda ingin mengirim permintaan ke server atau memproses data di sisi klien.
              
                    // Contoh aksi pencarian sederhana:
                    if (selectedProductCode) {
                      alert("Anda sedang mencari produk dengan kode: " + selectedProductCode);
                      // Tambahkan logika pencarian atau tindakan lain di sini
                    } else {
                      alert("Pilih kode produk terlebih dahulu.");
                    }
                  });
                });
              </script>

