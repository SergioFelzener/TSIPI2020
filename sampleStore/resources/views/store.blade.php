@extends('layouts.front')

@section('content')

<div class="row front">
    <div class="col-4">
            @if($store->logo)
            <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
        @else
            <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem Logo" class="img-fluid">
        @endif
    </div>
    <div class="col-8">
        <h2>{{ $store->name }}</h2>
        <p>{{$store->description}}</p>
        <p>
            <strong>Contato</strong>
            <span>{{ $store->phone }}</span>
        </p>
    </div>

       <div class="col-12">
            <hr>
           <h3 style="margin-bottom: 30px">Produtos</h3>
       </div>

            @forelse($store->produtos as $key => $produto)
                <div class="col-md-4">
                    <div class="card" style="width: 100%;">
                        @if($produto->fotos->count())
                            <img src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="" class="card-img-top">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}"  alt="" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{$produto->name}}</h2>
                                <p class="card-text">
                                    {{ $produto->description }}
                                </p>
                            <h3> R$ : {{ number_format($produto->price, '2', ',', '.')}}</h3>
                            <span> Loja : {{ $produto->store->name }} </span>
                            <div class="mt-5">
                                <a href="{{route('produto.single', ['slug' => $produto->slug])}}" class="btn btn-success">
                                    Ver Produto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(($key + 1) % 3 == 0)</div><div class="row front">@endif
            @empty
                <div class="col-12">
                    <h3 class="alert alert-warning"> Nenhum Produto encontrado para esta Loja! </h3>
                </div>

            @endforelse
    </div>

@endsection
