@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Carrinho de Compras</h2>
        <hr>
    </div>
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
</div>

@endsection
