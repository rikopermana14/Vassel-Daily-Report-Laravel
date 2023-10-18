@extends('layout.index')
@section('content')

@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" id="error-alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<script>
  // Fungsi untuk menghilangkan notifikasi dalam 5 detik
  setTimeout(function() {
    $('#success-alert').hide();
                                  $('#error-alert').hide();
                              }, 5000);
</script>


<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Inventory</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
          
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm">
                   <select id="exportLink" class="form-control">
                        <option>Export Data Table</option>
                        <option id="csv">Export as CSV</option>
                        <option id="excel">Export as XLS</option>
                        <option id="copy">Copy to clipboard</option> 
                        <option id="pdf">Export as PDF</option>
                      </select>  
                  </div>
                  
                  <div class="col-sm">
                  </div>
                  <div class="col-sm">
                  </div>
                  <div class="col-sm">
                    <div class="col-sm">
                      <a href="/product/add-product" class="btn btn-primary btn-sm">Add</a>
                      <a id="editBtn" class="btn btn-warning btn-sm" href="#">Edit</a>
                      <button type="button" class="btn btn-danger btn-sm text-center" data-toggle="modal" data-target="#deleteModal">
                        Delete
                    </button>

                  </div>
                 
                </div>
                
              </div>
              <div class="col-sm">
                <form action="/product/" method="GET">
                  <div class="form-group">
                      <label for="vessel">vessel:</label>
                      <select name="vessel" id="vessel" class="form-control">
                          <option value="">ALL vessel</option>
                          @foreach($users as $vessel)
              <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
          @endforeach
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Check Inventory</button>
              </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                   <div class="table-responsive">
                <table id="examplepro" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th >Select</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Product Image</th>
                      <th>Product Alias</th>
                      <th>Spesification</th>
                      <th>Product Type</th>  
                      <th>Stock</th>
                      <th>Vessel</th>     
                  </tr>
                                    </thead>
                                    <tfoot>
                  <tr>
                      <th>Select</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Product Image</th>
                      <th>Product Alias</th>
                      <th>Spesification</th>
                      <th>Product Type</th>
                      <th>Stock</th>  
                      <th>Vessel</th>  
                  </tr>
                  </tfoot>
                  <tbody> 
                    @foreach ($data as $item)
                       <tr>      
                        <td ><input type="radio"name="selected_product" class="select-product" data-product-id="{{ Crypt::encrypt($item->id) }}"></td>
                      <td>{{ $item->product_id }}</td>
                      <td>{{ $item->name }}</td>
                      <td><img src="{{ asset('image').'/'.$item->image }}" class="img-round elevation-2" height="80" width="80"></td>
                      <td>{{ $item->alias }}</td>
                      <td>{{ $item->spec }}</td>
                      <td>{{ $item->type }}</td>
                      <td>{{ $item->stock }}</td>
                      <td>{{ $item->user }}</td>
                    </tr>
                      @endforeach
                                    </tbody>
                                </table>
                              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Are you sure you want to delete this product?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a id="deleteConfirmBtn" class="btn btn-danger">Delete</a> <!-- Hapus href dan tambahkan class "btn btn-danger" -->
          </div>
      </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var deleteUrl = '';

    $('.btn-danger').click(function() {
        var selectedRadio = $('input[name="selected_product"]:checked');
        if (selectedRadio.length > 0) {
            var encryptedId = selectedRadio.attr('data-product-id');
            deleteUrl = "{{ route('product.hapus', ':encryptedId') }}".replace(':encryptedId', encryptedId);
        } else {
            alert("No item selected for deletion.");
        }
    });

    $('#deleteConfirmBtn').click(function() {
        if (deleteUrl !== '') {
            window.location.href = deleteUrl; // Redirect ke URL delete saat tombol "Delete" di modal diklik
        } else {
            alert("No item selected for deletion.");
        }
    });
});
</script>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var editBtn = document.getElementById("editBtn");

        editBtn.addEventListener("click", function() {
            var selectedRadio = document.querySelector('.select-product:checked');
            if (selectedRadio) {
                var encryptedId = selectedRadio.getAttribute('data-product-id');
                var editUrl = "{{ route('product.edit', ':encryptedId') }}".replace(':encryptedId', encryptedId);
                window.location.href = editUrl;
            } else {
                alert("Please select a product to edit.");
            }
        });
    });
</script>



@endsection