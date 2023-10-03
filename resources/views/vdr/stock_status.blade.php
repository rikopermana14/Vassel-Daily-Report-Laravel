<div class="card-body">
  @if (auth()->user()->hasRole('admin')|| auth()->user()->hasRole('vessel'))
  <div class="row">
<div class="col-sm-6">
 <div class="form-group">
   <label>Date</label>
        <div class="input-group date" id="stock_date" data-target-input="nearest">
          <input name="stock_date" id="stock_date_input" type="text" class="form-control datetimepicker-input" data-target="#stock_date"/>
          <div class="input-group-append" data-target="#stock_date" data-toggle="datetimepicker">
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
        <label>Product Code</label>
        <input type="text" name="productkode" class="form-control" id="productkode" readonly>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Product Name</label>
        <select class="form-control" name="productnama" id="productnama">
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
        <textarea class="form-control" name="spec" id="spec" rows="5"></textarea>
      </div>
    </div>
  </div>
  
  <!-- Add the remaining input fields with proper name attributes -->
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Previous</label>
        <input type="text" name="previous"id="previous" class="form-control" readonly>
      </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Received</label>
    <input type="text" name="received" id="received" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Used</label>
    <input type="text" name="used" id="used_stock" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Transfered</label>
    <input type="text" name="transfered" id="transfered" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Sounding</label>
    <input type="text" name="sounding" id="sounding" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Remain</label>
    <input type="text" name="remain" id="remain" class="form-control" readonly>
    </div>
    </div>
  </div>

  <button id="addstock" class="btn btn-primary">Add</button>
@endif




<script>
  document.addEventListener("DOMContentLoaded", function () {
    const produkkode = document.getElementById("productkode");
    const produknama = document.getElementById("productnama");
    const produkspec = document.getElementById("spec");
    const produkremain = document.getElementById("remain");
    const produkused = document.getElementById("used_stock");
    const produkprevious = document.getElementById("previous");
    const dataproduk = {!! json_encode($data1) !!}; // Memasukkan data produk dari PHP ke JavaScript
    
    const produkkodeedit = document.getElementById("edit_productkode");
    const produknamaedit = document.getElementById("edit_productnama");
    const produkspecedit = document.getElementById("edit_spec");
    const produkremainedit = document.getElementById("edit_remain");
    const produkusededit = document.getElementById("edit_used1");
    const produkpreviousedit = document.getElementById("edit_previous");
    const dataprodukeditedit = {!! json_encode($data1) !!}; // Memasukkan data produk dari PHP ke JavaScript


    produknama.addEventListener("change", function () {
      console.log("Script executed");
      const selekprodukName = produknama.value;
      const selekproduk = dataproduk.find(product => product.name === selekprodukName);

      if (selekproduk) {
        produkkode.value = selekproduk.product_id;
        produkspec.value = selekproduk.spec;
        produkprevious.value = selekproduk.stock;
      } else {
        produkkode.value = "";
      }
    });

    produkused.addEventListener("input", function () {
  console.log("Script executed");
  const usedValue = parseFloat(produkused.value);
  const previousValue = parseFloat(produkprevious.value);

  if (!isNaN(usedValue) && !isNaN(previousValue)) {
    const updatedRemain = previousValue - usedValue;
    produkremain.value = updatedRemain;
  }
});

    produknamaedit.addEventListener("change", function () {
      console.log("Script executed");
      const selekprodukNameedit = produknamaedit.value;
      const selekprodukedit = dataproduk.find(product => product.name === selekprodukNameedit);

      if (selekprodukedit) {
        produkkodeedit.value = selekprodukedit.product_id;
        produkspecedit.value = selekprodukedit.spec;
        produkpreviousedit.value = selekprodukedit.stock;
      } else {
        produkkodeedit.value = "";
      }
    });
    produkusededit.addEventListener("input", function () {
  console.log("Script executed");
  const usedValueedit = parseFloat(produkusededit.value);
  const previousValueedit = parseFloat(produkpreviousedit.value);

  if (!isNaN(usedValueedit) && !isNaN(previousValueedit)) {
    const updatedRemainedit = previousValueedit - usedValueedit;
    produkremainedit.value = updatedRemainedit;
  }
});
  });
</script>



 <div class="row">
  <div class="table-responsive">
    <table id="tablestock" class="display table table-hover" >
        <thead>
            <tr>
                <th>Date</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Spec</th>
                <th>Previous</th>
                <th>Received</th>
                <th>Used</th>
                <th>Transfered</th>
                <th>Sounding</th>
                <th>Remain</th>
         
                <th style="width: 10%">Action</th>
            </tr>
        </thead>
           <tbody id="show_stock">
                            </tbody>
           
           
     
    </table>
</div>
</div>
</div>

 <!-- /.tab-pane -->
 <!-- Delete Modal -->
 <div class="modal fade" id="delete_modal_stock" tabindex="-1" role="dialog" aria-labelledby="delete_modal_stockLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_modal_stockLabel">Delete Stock Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Stock?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm_delete_stock">Delete</button>
      </div>
    </div>
  </div>
</div>

@include('vdr.modal_edit.modal_stock')

 <script>
  $(document).ready(function() {
      let id_user = {{auth()->user()->id}};
      let idToDelete;
      

      getstock(); 
      {{--  $('#tablestock').dataTable();  --}}

      //fungsi tampil barang
      function getstock() {
          $.ajax({
              type: 'GET',
              url: '{{ route('stock.ajaxstock') }}',
         
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
                       <td>` + data.details[i].code_product + `</td> 
                       <td>` + data.details[i].name_product + `</td>  
                       <td>` + data.details[i].spec + `</td> 
                       <td>` + data.details[i].previous + `</td> 
                       <td>` + data.details[i].received + `</td> 
                       <td>` + data.details[i].used + `</td> 
                       <td>` + data.details[i].transfered + `</td> 
                       <td>` + data.details[i].sounding + `</td> 
                       <td>` + data.details[i].remain + `</td> 
                     
                       <td class="text-center">
                          <button class="btn btn-warning btn-round ml-auto btn-sm baggage_edit" data-toggle="modal" data-target="#editModalstock" data="` +
                          data.details[i].id +
                          `">
                            <i class="fa fa-edit"></i>
                            Edit
                          </button>
                          <button class="btn btn-danger btn-round ml-1 btn-sm baggage_hapus" data-toggle="modal" data-target="#delete_modal_stock" data="` + 
                            data.details[i].id + `">
                          <i class="fas fa-trash-alt"></i> Delete
                          </button>
                      </td>
                    </tr>
                    `;
                  }
                  html += `
                

                  `
                  $('#show_stock').html(html);
              }
          });
      }
      



//ADD Baggage
      $('#addstock').on('click', function() {
            var formData = new FormData();
          formData.append('_method', $('#_methodAdd').val());
          formData.append('_token', $('#_tokenAdd').val());
          formData.append('_enctype', $('#_enctype').val());
          formData.append('date', $('#stock_date_input').val());
          formData.append('code_product', $('#productkode').val());
          formData.append('name_product', $('#productnama').val());
          formData.append('spec', $('#spec').val());
          formData.append('previous', $('#previous').val());
          formData.append('received', $('#received').val());
          formData.append('used', $('#used_stock').val());
          formData.append('transfered', $('#transfered').val());
          formData.append('sounding', $('#sounding').val());
          formData.append('remain', $('#remain').val());
          formData.append('user_input', $('#user_input').val());
          

          $.ajax({
             type: 'POST',
              url: '{{ route('stock.addstock') }}',
              processData: false,
              contentType: false,
              data: formData,
              success: function(data) {
    console.log(data); // Tampilkan respons dari server di konsol
    getstock();
  },
  error: function(xhr, textStatus, errorThrown) {
    console.log(xhr.responseText); // Tampilkan pesan kesalahan jika terjadi
  }
          });

          return false;
      });

      //untuk dellete 
      function deletestock(id) {
$.ajax({
  type: 'POST',
  url: '{{ route('stock.deletestock') }}', // Ubah URL sesuai dengan rute Anda
  data: {
      _token: $('#_tokenAdd').val(),
      id: id
  },
  success: function(data) {
      $('#delete_modal_stock').modal('hide');
      getstock();
  }
});
}

$('#tablestock').on('click', '.baggage_hapus', function() {
idToDelete = $(this).attr('data');
$('#delete_modal_stock').modal('show');
});

$('#confirm_delete_stock').on('click', function() {
if (idToDelete) {
  deletestock(idToDelete);
  idToDelete = null;
}
});
     // Function to edit a daily activity
function editstock(id) {
var formData = new FormData();
formData.append('_method', 'PUT'); // Menggunakan metode PUT untuk edit
formData.append('_token', $('#_tokenAdd').val());
formData.append('date', $('#edit_datestock').val());
          formData.append('code_product', $('#productkode').val());
          formData.append('name_product', $('#productnama').val());
          formData.append('spec', $('#spec').val());
          formData.append('previous', $('#previous').val());
          formData.append('received', $('#received').val());
          formData.append('used', $('#used_stock').val());
          formData.append('transfered', $('#transfered').val());
          formData.append('sounding', $('#sounding').val());
          formData.append('remain', $('#remain').val());
          formData.append('user_input', $('#user_input').val());

$.ajax({
type: 'POST', // Anda juga bisa gunakan method PUT sesuai kebutuhan Anda
url: '/stock/' + id, // Ubah URL sesuai dengan rute yang benar
processData: false,
contentType: false,
data: formData,
success: function(data) {
$('#editModalstock').modal('hide');
getstock();
}
});
}

// Function to populate the edit modal
function populateEditModal(id) {
$.ajax({
type: 'GET',
url: '/stock/' + id,
async: true,
dataType: 'json',
success: function(data) {
  $('#edit_id').val(data.id);
  $('#edit_datestock').val(data.date);
  $('#edit_productkode').val(data.productkode);
  $('#edit_productnama').val(data.productnama);
  $('#edit_spec').val(data.spec);
  $('#edit_previous').val(data.previous);
  $('#edit_received').val(data.received);
  $('#edit_used1').val(data.used);
  $('#edit_transfered').val(data.transfered);
  $('#edit_sounding').val(data.sounding);
  $('#edit_remain').val(data.remain);
}
});
}

$('#tablestock').on('click', '.baggage_edit', function() {
idToEdit = $(this).attr('data');
populateEditModal(idToEdit);
$('#editModalstock').modal('show');
});

$('#confirm-Edit-stock').on('click', function() {
if (idToEdit) {
editstock(idToEdit);
idToEdit = null;
}
});
});
</script>   
  
  





