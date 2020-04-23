@extends('layouts.front')

@section('content')

<h2>Samples</h2>

<div class="carousel-wrapper">

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
                                        <span id="current-duration">00:00</span>
                                    </div>
                    
                                    <div class="player-seekbar">
                                        <input id="seekbar" type="range" min="0" max="" step="1">
                                    </div>
                    
                                    <div class="player-total-duration">
                                        <span class="total-duration">00:00</span>
                                    </div>
                                </div>
                    
                                <div class="buttons-wrapper">
                                    <div class="favorite-button">
                                        <img class="favorite-button-icon" src="./assets/img/audio/heart-icon.svg" alt="Favorite icon">
                                    </div>
                                    
                                    <div id="paused" class="play-pause-button">
                                        <img class="play-pause-button-icon" src="./assets/img/audio/play-icon.svg" alt="Play/Pause icon">
                                    </div>
                                    
                                    <div class="volume-button">
                                        <img class="volume-button-icon" src="./assets/img/audio/audio-icon.svg" alt="Volume icon">
                                    </div>
                                    
                                </div>
                    
                    </div>
                    
                </div>
        </div>   
        @endforeach
    </div>

</div>

@endsection