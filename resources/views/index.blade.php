@extends('layout.index')
@section('content')

<div class="container">
    <div class="row flex-row">
      <div class="col-6 col-sm-4">
        <div class="card" style="width: 18rem;">
          <i class="fas fa-ship custom-icon-size"></i>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .custom-icon-size {
      font-size:120px ; /* Ubah angka sesuai ukuran yang diinginkan */
    }
  </style>
  

@endsection