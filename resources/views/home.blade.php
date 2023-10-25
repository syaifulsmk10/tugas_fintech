@extends('layouts.app')

<?php 
    $page = 'Home';
?>

@section('content')

{{-- Ini Tempat Home User --}}

 @if (auth()->check() && auth()->user()->role === "siswa")
<div class="container">
    <div class="row justify-content-center">
    
    <div class="container">
       
        <h1>
            Welcome, {{Auth::user()->role}}
        </h1>
         <div class="mb-4 mt-4">
       <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Saldo Anda</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{number_format($saldo, 2)}}</h6>
                <div class="col d-flex justify-content-end">
                    {{-- <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#formTopUp" >Top up</button> --}}

                    <form method="POST" action="{{ route('topupnow') }}">
                        @csrf
                         <div class="mb-3">
                            <input type="number" name="jumlah" class="form-control" min="10000" value="10000">
                                </div>
                                    <button type="submit" class="btn btn-primary">Top Up Sekarang</button>

                        {{-- <div class="modal fade" id="formTopUp" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="number" name="jumlah" class="form-control" min="10000" value="10000">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Top Up Sekarang</button>
                                </div>
                                </div>
                            </div>
                            </div> --}}
                    </form>
                </div>
            </div>
        </div>
        </div>
</div>
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <div class="row">
             @foreach ($products as $key => $product )
                <div class="col-4 mb-4">
                    <form method="POST" action="{{route('addToCart')}}">
                     @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <input type="hidden" value="{{$product->price}}" name="price">
                          <div class="card">
                          <div class="card-header">
                                {{$product->name}}
                          </div>
                            <div class="card-body">
                                <img src="{{$product->photo}}"  />
                                <div class="d-flex justify-content-center fw-bold"  >{{$product->desc}}</div>
                                <div class="mt-5 d-flex justify-content-end">Harga: {{number_format($product->price)}}</div>
                            </div>
                            <div class="card-footer">
                                <div class="mb-3">
                                    <input class="form-control" type="number" name="quantity" value="0" min="0">
                                </div>
                                <div class="d-grid gap-2">
                                     <button  type="submit" class="btn btn-primary">+ AddToCart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            @endforeach
        </div>
    </div>


    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Mata keranjang
            </div>
            <div class="card-body">
                <ul>
                    @foreach($carts as $key => $cart)
                        <li>{{$cart->product->name}} | {{$cart->price}} x {{$cart->quantity}}</li>
                    @endforeach
                </ul>
                Total Biaya: {{number_format($total_biaya)}}
            </div>
            <div class="card-footer">
                <form action="{{route('payNow')}}" method="POST">
                    <div class="d-grid gap-2">
                        @csrf
                        <button class="btn btn-success" type="submit">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card md-3 mt-3">
            <div class="card-header">
                Mutasi Dompet
            </div>
            <div class="card-body">
                <ul>
                    @foreach ( $mutasi as $data )
                        <li>{{$data->credit ? $data->credit: 'Debit'}} | {{$data->debit ? $data->debit : 'kredit'}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
    @endif


 @if (auth()->check() && auth()->user()->role === "bank")
 <div class="container">
           @foreach ( $request_topup as $request )
                             <div class="col-3 mb-3">
                                <form method="POST" action="{{ route('acceptRequest') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $request->id }}" name="id">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ $request->user->name }}
                                        </div>
                                        <div class="card-body">
                                           Nominal: {{ $request->credit }}
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Accept Request</button>
                                        </div>
                                    </div>
                                </form>
                             </div>
                        @endforeach
                 
                </div>
   




 
  @endif


{{-- Ini Tempat Home Admin --}}



{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection