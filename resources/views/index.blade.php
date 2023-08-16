@extends('layout.index')
@section('content')

<div class="container" >
  <div class="row flex-row" >
      @foreach ($data as $item)
      <div class="col-6 col-sm-4" >
        <div class="card" style="width: 18rem;background-color:cyan"  >
          <a href="">
          <center><i class="fas fa-ship custom-icon-size"></i></center>
          <h5 style="text-align: center;color:black"><br>{{ $item->vessel_name }}</h5>
      </div>
    </a>
      @endforeach
  </div>
</div>

  <style>
    .custom-icon-size {
      font-size:120px ;
      color: black;
    }
  </style>
  

@endsection