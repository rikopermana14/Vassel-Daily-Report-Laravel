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
<!-- Main content -->
<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vessel Daily Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Vessel Daily Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">General Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Daily Activities</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Running Hours Machine</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Consumption</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab" >Stock Status</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Payload</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Konten Tab Informasi Umum -->
                                <div class="tab-pane active" id="tab_1">
                                  <form action="/vdr/general-info" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.general_info')
                                    <button class="btn btn-primary">Save</button>
                              </form>
                                </div>
                             
                                <!-- Konten Tab Aktivitas Harian -->
                                <div class="tab-pane" id="tab_2">
                                  
                                    @include('vdr.daily_activities')
                                   
                            
                                </div>

                                <!-- Konten Tab Jam Operasi Mesin -->
                                <div class="tab-pane" id="tab_3">
                                  
                                    @include('vdr.running_hours_machine')
                                    

                                </div>

                                <!-- Konten Tab Konsumsi -->
                                <div class="tab-pane" id="tab_4">
                                  
                                    @include('vdr.consumption')

                                </div>

                                <!-- Konten Tab Status Stok -->
                                <div class="tab-pane" id="tab_5">
                                    @include('vdr.stock_status')
                                </div>

                                <!-- Konten Tab payload -->
                                <div class="tab-pane" id="tab_6">
                                    @include('vdr.payload')
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content -->
  </div>
  
</div>

<script>$(document).ready(function() {
    $('.nav-tabs a').on('click', function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
  </script>

<script>
  $(function () {
    //Date range picker for General Info
    $('#joined_date').datetimepicker({
      format: 'YYYY/MM/DD'
    });

    //Date range picker for Daily Activities
    $('#daily_date').datetimepicker({
      format: 'YYYY/MM/DD'
    });

    //Date range picker for Running Hours Machine
    $('#running_hours_date').datetimepicker({
      format: 'YYYY/MM/DD '
    });
    //Date range picker for consumtion
    $('#comsumption_date').datetimepicker({
      format: 'YYYY/MM/DD '
    });
    //Date range picker for payload
    $('#payload_date').datetimepicker({
      format: 'YYYY/MM/DD '
    });
    //Date range picker for Stock_Status
    $('#stock_date').datetimepicker({
      format: 'YYYY/MM/DD '
    });
    

    // Tangkap tanggal saat tanggal di "General Info" berubah
    $('#joined_date').on('change.datetimepicker', function(e) {
      // Ambil tanggal yang dipilih dari "General Info"
      var selectedDate = e.date.format('YYYY-MM-DD ');
      // Set tanggal di "Daily Activities" sesuai dengan tanggal di "General Info"
      $('#daily_date').data('datetimepicker').date(selectedDate);
      // Set tanggal di "Running Hours Machine" sesuai dengan tanggal di "General Info"
      $('#running_hours_date').data('datetimepicker').date(selectedDate);
      // Set tanggal di "Consumtion" sesuai dengan tanggal di "General Info"
      $('#comsumption_date').data('datetimepicker').date(selectedDate);
       // Set tanggal di "payload" sesuai dengan tanggal di "General Info"
      $('#payload_date').data('datetimepicker').date(selectedDate);
    });

  });
</script>


@endsection