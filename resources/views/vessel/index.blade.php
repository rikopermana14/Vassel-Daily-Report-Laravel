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
            <h1>Vessel File</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Vessel File</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        
        <div class="row">
          <div class="col-12">
       
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
                    <a href="/vessel/add" class="btn btn-primary btn-sm">Add</a>
                    <a id="editBtn" class="btn btn-warning btn-sm" href="#">Edit</a>
                      <button type="button" class="btn btn-danger btn-sm text-center" data-toggle="modal" data-target="#deleteModal">
                        Delete
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                                    <table id="exampleves" class="table table-bordered table-striped">
                  <thead>
            <tr>
                <th>Select</th>
                <th>Vessel Code</th>
                <th>Vessel Name</th>
                <th>Vessel Type</th>
                <th>Email</th>
                <th>Vessel Alias</th>
                <th>Flag</th>
                <th>Builder</th>
                <th>Year Built</th>
                <th>Class</th>
                <th>Official Number</th>
                <th>Call Sign</th>
                <th>Length Over All</th>
                <th>Length Perpendic</th>



            </tr>
                </thead>
                <tfoot>
            <tr>
                <th>Select</th>
                <th>Vessel Code</th>
                <th>Vessel Name</th>
                <th>Vessel Type</th>
                <th>Email</th>
                <th>Vessel Alias</th>
                <th>Flag</th>
                <th>Builder</th>
                <th>Year Built</th>
                <th>Class</th>
                <th>Official Number</th>
                <th>Call Sign</th>
                <th>Length Over All</th>
                <th>Length Perpendic</th>
            </tr>
                </tfoot>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <td><input type="radio"name="selected_vessel" class="select-vessel" data-product-id="{{ Crypt::encrypt($item->id) }}"></td>
                  <td>{{ $item->vessel_id }}</td>
                  <td>{{ $item->vessel_name }}</td>
                  <td>{{ $item->vessel_type }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->vessel_alias }}</td>
                  <td>{{ $item->country_flag }}</td>
                  <td>{{ $item->builder }}</td>
                  <td>{{ $item->year_built }}</td>
                  <td>{{ $item->class }}</td>
                  <td>{{ $item->official_number }}</td>
                  <td>{{ $item->call_sign }}</td>
                  <td>{{ $item->lenght_overall }}</td>
                  <td>{{ $item->length_perpendicular }}</td>
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
  
  <!-- Delete Modal -->
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Vessel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Are you sure you want to delete this Vessel?
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
        var selectedRadio = $('input[name="selected_vessel"]:checked');
        if (selectedRadio.length > 0) {
            var encryptedId = selectedRadio.attr('data-product-id');
            deleteUrl = "{{ route('vessel.hapus', ':encryptedId') }}".replace(':encryptedId', encryptedId);
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



  document.addEventListener("DOMContentLoaded", function() {
      var editBtn = document.getElementById("editBtn");

      editBtn.addEventListener("click", function() {
          var selectedRadio = document.querySelector('.select-vessel:checked'); // Menggunakan class "select-vessel"
          if (selectedRadio) {
              var encryptedId = selectedRadio.getAttribute('data-product-id');
              var editUrl = "{{ route('vessel.edit', ':encryptedId') }}".replace(':encryptedId', encryptedId);
              window.location.href = editUrl;
          } else {
              alert("Please select a vessel to edit.");
          }
      });
  });
</script>




@endsection