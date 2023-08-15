@extends('layout.index')

@section('content')

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab" role="tab">Stock Status</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Muatan</a></li>
                                <li>
                                    <a href="#" class="btn btn-warning">Kembali</a>
                                    <button class="btn btn-primary">Simpan</button>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Konten Tab Informasi Umum -->
                                <div class="tab-pane active" id="tab_1">
                                  <form action="/general-info" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.general_info')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
                                </div>
                             
                                <!-- Konten Tab Aktivitas Harian -->
                                <div class="tab-pane" id="tab_2">
                                  <form action="/daily-activities" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.daily_activities')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
                                </div>

                                <!-- Konten Tab Jam Operasi Mesin -->
                                <div class="tab-pane" id="tab_3">
                                  <form action="/running-hours-machine" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.running_hours_machine')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
                                </div>

                                <!-- Konten Tab Konsumsi -->
                                <div class="tab-pane" id="tab_4">
                                  <form action="/consumption" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.consumption')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
                                </div>

                                <!-- Konten Tab Status Stok -->
                                <div class="tab-pane" id="tab_5">
                                  <form action="/stock_status" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.stock_status')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
                                </div>

                                <!-- Konten Tab Muatan -->
                                <div class="tab-pane" id="tab_6">
                                  <form action="/muatan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('vdr.muatan')
                                    <button class="btn btn-primary">Simpan</button>
                              </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
  $(function () {
    //Date range picker for General Info
    $('#joined_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });

    //Date range picker for Daily Activities
    $('#daily_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });

    //Date range picker for Running Hours Machine
    $('#running_hours_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });
    //Date range picker for consumtion
    $('#comsumption_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });
    //Date range picker for muatan
    $('#muatan_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });
    //Date range picker for Stock_Status
    $('#stock_date').datetimepicker({
      format: 'YYYY/MM/DD HH:mm'
    });

    // Tangkap tanggal saat tanggal di "General Info" berubah
    $('#joined_date').on('change.datetimepicker', function(e) {
      // Ambil tanggal yang dipilih dari "General Info"
      var selectedDate = e.date.format('YYYY-MM-DD HH:mm');
      // Set tanggal di "Daily Activities" sesuai dengan tanggal di "General Info"
      $('#daily_date').data('datetimepicker').date(selectedDate);
      // Set tanggal di "Running Hours Machine" sesuai dengan tanggal di "General Info"
      $('#running_hours_date').data('datetimepicker').date(selectedDate);
      // Set tanggal di "Consumtion" sesuai dengan tanggal di "General Info"
      $('#comsumption_date').data('datetimepicker').date(selectedDate);
       // Set tanggal di "Muatan" sesuai dengan tanggal di "General Info"
      $('#muatan_date').data('datetimepicker').date(selectedDate);
    });

  });
</script>


@endsection