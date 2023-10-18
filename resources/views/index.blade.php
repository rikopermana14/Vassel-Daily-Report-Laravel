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
    @if (auth()->user()->hasRole('admin')||auth()->user()->hasRole('purchasing'))
    <div class="row">
        @foreach ($data as $item)
        @php
                // Inisialisasi variabel untuk menentukan apakah stok ada yang kurang atau medium
                $stockLow = false;
                $medium = false;
            @endphp

            @foreach ($inventory as $product)
                @if ($product->id_user == $item->id_user && $product->stock < 5)
                    @php
                        $stockLow = true;
                        break; // Keluar dari loop jika stok kurang ditemukan
                    @endphp
                @elseif ($product->id_user == $item->id_user && $product->stock >= 5 && $product->stock <= 30)
                    @php
                        $medium = true;
                        break; // Keluar dari loop jika stok medium ditemukan
                    @endphp
                @endif
            @endforeach

            <div class="col-6 col-sm-4">
                <div class="card @if($stockLow) low-stock @elseif($medium) medium-stock @endif" style="width: 18rem;">
                     <a href="{{ route('product', ['vessel' => $item->id_user]) }}">
                        <div class="indicator"> <!-- Indikator tanda seru -->
                            @if ($stockLow)
                                <i class="fas fa-exclamation-circle"></i>
                            @elseif ($medium)
                                <i class="fas fa-exclamation-circle"></i>
                            @endif
                        </div>
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
            <div class "card" style="width: 18rem; background-color: #e6b215 ;">
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
    .card {
        background-color: #00ff00; /* Hijaun (default) */
    }

    .card.low-stock {
        background-color: #ff0000; /* Merah jika stok kurang dari 5 */
    }

    .card.medium-stock {
        background-color: #ffff00; /* Kuning jika stok antara 5-30 */
    }

    .card.high-stock {
        background-color: #00ff00; /* Hijau jika stok lebih dari 30 */
    }

    .card.low-stock .indicator,
    .card.medium-stock .indicator {
        display: block; /* Tampilkan indikator hanya pada stok rendah dan sedang */
    }

    .indicator {
        display: none; /* Sembunyikan indikator secara default */
    }
</style>

@endsection
