@extends('layout.index')
@section('content')

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <input type="text" id="date-range">
          </div>
    
          <div class="col-sm">
            <select id="exportLink" class="form-control">
              <option>Export Data Table</option>
              <option id="csv">Export as CSV</option>
              <option id="excel">Export as XLS</option>
              <option id="copy">Copy to clipboard</option>
              <option id="pdf">Export as PDF</option>
            </select>
          </div>
        </div>
      </div>

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
                        
                    </div>
                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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



@endsection