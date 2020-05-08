@extends('layouts.front')

@section('content')

<div class="sample-wrapper">

        <div class="samples-title">
            <h1>{{ $categoria->name }}</h1>
        </div>

        <div class="all-samples-container">
        @forelse($categoria->produtos as $key => $produto)
        <div class="sample-item">
                    <div class="player-container">

                        <div class="player-cover-image">
                            @if($produto->fotos->count())
                                <img class="sample-cover-image" src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="Sample image">
                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}"  alt="" class="card-img-top">
                            @endif
                                <div class="player-add-icon">
                                    <a href="{{route('produto.single', ['slug' => $produto->slug])}}">
                                            <img src="../assets/img/audio/add-icon.svg" alt="Add to cart icon">
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
                                        <img class="favorite-button-icon" src="../assets/img/audio/heart-icon.svg" alt="Favorite icon">
                                    </div>
                                    
                                    <div id="paused" class="play-pause-button">
                                        <img class="play-pause-button-icon" src="../assets/img/audio/play-icon.svg" alt="Play/Pause icon">
                                    </div>
                                    
                                    <div class="volume-button">
                                        <img class="volume-button-icon" src="../assets/img/audio/audio-icon.svg" alt="Volume icon">
                                    </div>
                                    
                                </div>
                    
                    </div>
                    
                </div>
        </div>   
        @empty
                <div class="col-12">
                    <h3 class="alert alert-warning"> Nenhum Produto encontrado para esta Categoria! </h3>
                </div>

            @endforelse
        </div>

</div>


<!-- <div class="row front">
    <div class="col-12">
       <h2>{{ $categoria->name }}</h2>
       <hr>
    </div>
            @forelse($categoria->produtos as $key => $produto)
                <div class="col-md-4">
                    <div class="card" style="width: 100%%;">
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
                    <h3 class="alert alert-warning"> Nenhum Produto encontrado para esta Categoria! </h3>
                </div>

            @endforelse
    </div> -->

@endsection
