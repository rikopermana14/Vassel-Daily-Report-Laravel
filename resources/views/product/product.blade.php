@extends('layout.index')
@section('content')

<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product File</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product File</li>
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
                      <a href="/add-product" class="btn btn-primary">Add</a>
                      <a id="editBtn" class="btn btn-warning" href="#">Edit</a>
                      <button type="button" class="btn btn-danger btn-sm text-center" data-toggle="modal" data-target="#deleteModal">
                        Delete
                    </button>

                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                   <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>Select</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Product Image</th>
                      <th>Product Alias</th>
                      <th>Spesification</th>
                      <th>Product Type</th>       
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
                  </tr>
                  </tfoot>
                  <tbody> 
                    @foreach ($data as $item)
                       <tr>      
                        <td><input type="radio"name="selected_product" class="select-product" data-product-id="{{ Crypt::encrypt($item->id) }}"></td>
                      <td>{{ $item->product_id }}</td>
                      <td>{{ $item->name }}</td>
                      <td><img src="{{ asset('image').'/'.$item->image }}" class="img-round elevation-2" height="100" width="100"></td>
                      <td>{{ $item->alias }}</td>
                      <td>{{ $item->spec }}</td>
                      <td>{{ $item->type }}</td>
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
              <a id="deleteConfirmBtn" class="btn btn-danger" href="{{ route('product.hapus', Crypt::encrypt ($item->id)) }}">Delete</a>
          </div>
      </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      var deleteUrl = '';

      $('.btn-danger').click(function() {
          deleteUrl = $(this).attr('href'); // Menyimpan URL delete saat tombol "Delete" diklik
      });

      $('#deleteConfirmBtn').click(function() {
          window.location.href = deleteUrl; // Redirect ke URL delete saat tombol "Delete" di modal diklik
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