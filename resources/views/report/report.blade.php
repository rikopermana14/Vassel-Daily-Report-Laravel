@extends('layout.index')
@section('content')

@php
$selectedVesselId = $bioskopId; // Inisialisasi $selectedVesselId dengan nilai $vesselId
@endphp
<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report VDR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active">Report VDR</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
          
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-sm">
            <button id="export-data" class="btn btn-secondary">Export ALL Data as CSV</button>
            <a href="{{ url('/report/cetak-pdf?start_date=' . $startDate . '&end_date=' . $endDate . '&vessel=' . $selectedVesselId) }}" class="btn btn-secondary">Export ALL Data as PDF</a>
          </div>
    
        </div>

        <form action="/report/report" method="GET">
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        <div class="form-group col-md-4">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        <div class="form-group col-md-4">
              <label for="vessel">vessel:</label>
              <select name="vessel" id="vessel" class="form-control">
                  <option value="">ALL vessel</option>
                  @foreach($users as $vessel)
      <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
  @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Check Report</button>
        </div>
      </form>
      </div>

                    <div class="card">
                        <div class="card-body">
                          <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">General Info</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Daily Activities</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Running Hours Machine</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Consumption</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab" >Stock Status</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Payload</a></li>
                        </ul>
                          <div class="tab-content">
                              <!-- Konten Tab Informasi Umum -->
                              <div class="tab-pane active" id="tab_1">
                                  @include('report.tab.general_info')
                              </div>
                           
                              <!-- Konten Tab Aktivitas Harian -->
                              <div class="tab-pane" id="tab_2">    
                                  @include('report.tab.daily_activity')
                                 
                              </div>
          
                              <!-- Konten Tab Jam Operasi Mesin -->
                              <div class="tab-pane" id="tab_3">
                                  @include('report.tab.running_hours_machine')                                    
                              </div>
          
                              <!-- Konten Tab Konsumsi -->
                              <div class="tab-pane" id="tab_4">                                  
                                  @include('report.tab.consumption')
                              </div>
          
                              <!-- Konten Tab Status Stok -->
                              <div class="tab-pane" id="tab_5">
                                  @include('report.tab.stock_status')
                              </div>
          
                              <!-- Konten Tab payload -->
                              <div class="tab-pane" id="tab_6">
                                  @include('report.tab.payload')
                              </div>
                          </div>
                          <!-- /.tab-content -->
                      </div><!-- /.card-body -->
                    </div>
                
                
              </div>
              <!-- /.card-header -->
              
            </div>
            <!-- /.card -->
          


  <script>
    document.getElementById('vessel').addEventListener('change', function() {
        var selectedVesselId = this.value;
        document.getElementById('vessel_id').value = selectedVesselId;
    });
</script>

@endsection