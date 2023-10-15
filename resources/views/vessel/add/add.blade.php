@extends('layout.index')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Main content -->
<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vessel Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vessel Add</li>
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
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Input Vessel File</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Page 1</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Page 2</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Page 3</a></li>
                  <form action="{{ isset($vessel) ? route('vessel.update',Crypt::encrypt ($vessel->id)): route('store-vessel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <li><a href="/vessel" class="btn btn-warning">Back</a>
                    <button type="submit" class="btn btn-info">Save</button>
                   </li>
                    
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 
                    <!-- Konten Tab Informasi Umum -->
                    <div class="tab-pane active" id="tab_1">
                        @include('vessel.add.page1')
                    </div>

                    <!-- Konten Tab Aktivitas Harian -->
                    <div class="tab-pane" id="tab_2">
                        @include('vessel.add.page2')
                    </div>

                    <!-- Konten Tab Jam Operasi Mesin -->
                    <div class="tab-pane" id="tab_3">
                        @include('vessel.add.page3')
                    </div>

                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
                  <!-- /.tab-pane -->

            </div>
          </form>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
  </div>
  @endsection