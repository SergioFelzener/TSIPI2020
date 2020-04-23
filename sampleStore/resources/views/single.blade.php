@extends('layouts.front')

@section('content')

        <div class="item">
                    <div class="player-container">

                        <div class="player-cover-image">
                            @if($produto->fotos->count())
                                <img class="sample-cover-image" src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="Sample image">
                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}"  alt="" class="card-img-top">
                            @endif
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

        <div class="produto-add col-md-12">
                <h3>
                    R$ : {{ number_format($produto->price, '2', ',', '.')}}
                </h3>

                <span>
                    Loja : {{ $produto->store->name }}
                </span>

                <hr>

                <form action="{{route('cart.add')}}" method="POST">
                    @csrf
                    <input type="hidden" name="produto[name]" value="{{$produto->name}}">
                    <input type="hidden" name="produto[price]" value="{{$produto->price}}">
                    <input type="hidden" name="produto[slug]" value="{{$produto->slug}}">
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" name="produto[amount]" class="form-control col-md-2" value="1">
                    </div>
                    <button class="btn btn-sm btn-danger">COMPRAR</button>
                </form>
            </div>


        </div>

</div>

<div class="row">
    <div class="col-12">
        <hr>
        {{ $produto->body }}
    </div>
</div>

@endsection