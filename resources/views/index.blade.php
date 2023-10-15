@extends('layout.index')
@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    @if (auth()->user()->hasRole('admin')|| auth()->user()->hasRole('operation'))
    <div class="row">
        @foreach ($data as $item)
        <div class="col-6 col-sm-4">
            <div class="card" style="width: 18rem; background-color: #e6b215;">
                <a href="{{ route('product', ['vessel' => $item->id]) }}">
                    <center><i class="fas fa-ship custom-icon-size"></i></center>
                    <h5 style="text-align: center; color: black;"><br>{{ $item->vessel_name }}</h5>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @if (auth()->user()->hasRole('vessel'))
    <div class="row">
        @foreach ($user as $item)
        <div class="col-6 col-sm-4">
            <div class="card" style="width: 18rem; background-color: #e6b215 ;">
                    <center><i class="fas fa-ship custom-icon-size"></i></center>
                    <h5 style="text-align: center; color: black;"><br>{{ $item->vessel_name }}</h5>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .custom-icon-size {
        font-size: 120px;
        color: black;
    }
</style>

@endsection
