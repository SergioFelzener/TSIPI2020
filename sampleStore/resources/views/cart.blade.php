@extends('layouts.front')

@section('content')

<div class="samples-title">
    <h1>Meu carrinho</h1>
</div>

@if($cart)
<div class="cart-container">  

    @php $total = 0; @endphp
    @foreach($cart as $c)
    <div class="cart-item">
        <div class="cart-item-image">
            
        </div>

        <div class="cart-item-details">
            <p>{{$c['name']}}</p>

            <p>Category</p>

            <p>R$ {{$c['price'], 2, ',' , '.'}}</p>
            @php

            $subtotal = $c['price'] * $c['amount'];
            $total += $subtotal;

            @endphp
        </div>

        <div class="cart-delete">
            <a href="{{route('cart.remove', ['slug' => $c['slug']])}}">
                <img src="../assets/img/delete-icon.svg" alt="delete">
            </a>
            </a>
        </div>
    </div>
    @endforeach

</div>

<div class="cart-container">  

    <div class="cart-item-total">
        <div class="cart-item-image">
            <p>Total</p> 
        </div>

        <div class="cart-item-details">
            
            <p>R$ {{$total, 2, ',' , '.'}}</p>

        </div>

        <div class="cart-delete">
            <a href="{{route('cart.cancel')}}">
                <img src="../assets/img/delete-icon.svg" alt="delete">
            </a>
            </a>
        </div>
    </div>

</div>

<div class="double-buttons-cart">
        <a href="{{route('home')}}" class="button-cancel">Continuar comprando</a href="">
        <a href="{{route('checkout.index')}}" class="button-checkout">Finalizar Compra</a>
</div>

@else
    <div class="alert alert-danger">CARRINHO VAZIO</div>
@endif



<!-- <div class="row">
        
    <div class="col-12">
        @if($cart)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>SubTotal</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $c)
                <tr>
                    <td>{{$c['name']}}</td>
                    <td>R$ {{$c['price'], 2, ',' , '.'}}</td>
                    <td>{{$c['amount']}}</td>
                    @php

                        $subtotal = $c['price'] * $c['amount'];
                        $total += $subtotal;

                    @endphp
                    <td>R$ {{($subtotal), 2, ',' , '.'}}</td>
                    <td>
                        <a href="{{route('cart.remove', ['slug' => $c['slug']])}}" class="btn btn-sm btn-danger">REMOVER</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total : </td>
                    <td colspan="2">R$ {{$total, 2, ',' , '.'}}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="col-md-12">
            <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-right">CONCLUIR COMPRA</a>
            <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left">CANCELAR COMPRA</a>
        </div>
        @else
            <div class="alert alert-danger">CARRINHO VAZIO</div>
        @endif
    </div>
</div> -->

@endsection
