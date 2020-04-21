@extends('layouts.front')

@section('content')

<div style="color: black;" class="row front">

    @foreach($produtos as $key => $produto)
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
                        <!-- {{ $produto->audio->audio }} -->
                    </p>
                    <h3>
                        R$ : {{ number_format($produto->price, '2', ',', '.')}}
                    </h3>
                    <span>
                        Loja : {{ $produto->store->name }}
                    </span>
                    <div class="mt-5">
                    <a href="{{route('produto.single', ['slug' => $produto->slug])}}" class="btn btn-success">
                    Ver Produto
                    </a>
                    </div>
                </div>
            </div>
        </div>
        @if(($key + 1) % 3 == 0)</div><div class="row front">@endif
    @endforeach

</div>

<div class="row front">
    <div class="col-md-4">
        @foreach($categorias as $key => $categoria)
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{$categoria->name}}</h2>
                    <p class="card-text">
                        {{ $categoria->description }}
                    </p>
                    <div class="mt-5">
                    <a href="{{route('categoria.single', ['slug' => $categoria->slug])}}" class="btn btn-success">
                    Ver Categoria
                    </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Lojas Destaque</h2>
        <hr>
    </div>
    @foreach($stores as $store)
    <div class="col-4">
        @if($store->logo)
            <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
        @else
            <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem Logo" class="img-fluid">
        @endif

    <h3>{{$store->name}}</h3>
    <p>{{$store->description}}</p>

    <a href="{{route('store.single', ['slug' => $store->slug])}} " class="btn btn-sm btn-success">Ver Loja</a>

    </div>
@endforeach
</div>

@endsection
