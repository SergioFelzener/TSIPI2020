@extends('layouts.front')

@section('content')

<h2>Samples</h2>

<div class="row front">

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
@endsection
