@extends('layouts.front')

@section('content')

<!-- Vini Layout Home -->

<section class="hero-container">

    <div class="hero-container-text">

        <h1>Explore nossa biblioteca de samples</h1>

        <p>Os audios completos são disponibilizados apenas após a compra</p>

    </div>

    <div class="hero-container-image">
        <img src="./assets/img/vinyl-side-img.png" alt="Sample Image">
    </div>

</section>

<div class="carousel-wrapper-1">

    <div class="owl-carousel">

        @foreach($produtos as $key => $produto)
        <div class="item">
                    <div class="player-container">

                        <div class="player-cover-image">
                            @if($produto->fotos->count())
                                <img class="sample-cover-image" src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="Sample image">
                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}"  alt="" class="card-img-top">
                            @endif
                                <div class="player-add-icon">
                                    <a href="{{route('produto.single', ['slug' => $produto->slug])}}">
                                        <img src="./assets/img/audio/add-icon.svg" alt="Add to cart icon">
                                    </a>
                                </div>
                            </div>

                            <div class="player-description">
                                <p class="sample-name">{{$produto->name}}</p>
                                <p class="sample-category">{{ $produto->description }}</p>
                            </div>

                            <div class="player-controls">

                                <div class="seekbar-wrapper">
                                    <audio src="{{ asset('storage/' . $produto->audio->audio)}}" class="sample-audio"></audio>

                                    <div class="player-current-duration">
                                        <span class="current-duration">00:00</span>
                                    </div>

                                    <div class="player-seekbar">
                                        <input class="seekbar" type="range" min="0" max="" step="1">
                                    </div>

                                    <div class="player-total-duration">
                                        <span class="total-duration">00:00</span>
                                    </div>
                                </div>

                                <div class="buttons-wrapper">
                                    <div class="favorite-button">
                                        <img class="favorite-button-icon" src="./assets/img/audio/heart-icon.svg" alt="Favorite icon">
                                    </div>

                                    <div data-pause="paused" class="play-pause-button">
                                        <img class="play-pause-button-icon" src="./assets/img/audio/play-icon.svg" alt="Play/Pause icon">
                                    </div>

                                    <div class="volume-button" data-mute="">
                                        <img class="volume-button-icon" src="./assets/img/audio/audio-icon.svg" alt="Volume icon">
                                    </div>

                                </div>

                    </div>

                </div>
        </div>
        @endforeach
    </div>

</div>


<div class="carousel-wrapper">

    <div class="owl-carousel">

        @foreach($categorias as $key => $categoria)
        <div class="item">

            <div class="category-box">
                <div class="category-cover-image">
                    <img src="" alt="">
                </div>

                <div class="category-description">
                    <p class="category-name">{{$categoria->name}}</p>
                    <p class="category-description-text">{{ $categoria->description }}</p>
                </div>

                <a class="ver-tudo" href="{{route('categoria.single', ['slug' => $categoria->slug])}}">Ver tudo</a>
            </div>

        </div>
        @endforeach
    </div>

</div>



<!-- Vini Layout Home -->

<!-- Layout antigo -->

<!-- <div style="color: black;" class="row front">

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
</div> -->


<!-- Layout antigo -->

@endsection
