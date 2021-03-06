@extends('layouts.front')

@section('content')

<div class="container" style="min-height: 500px;">

    <div class="row">
        <div class="col-12">
            <h2>Meus Pedidos</h2>
            <hr>
        </div>

        <div class="col-12">
            <div id="accordion">
                @forelse($userOrders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido n˚ {{ $order->reference }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{ $key }}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    @php $itens = unserialize($order->itens);@endphp
                                    @foreach($itens as $item)

                                    <li>{{$item['name']}} R$ {{number_format($item['price'],2, ',', '.')}} Total R$ {{number_format($item['price'] * $item['amount'],2, ',', '.')}}</li>
                                    @endforeach

                                    <li class="mt-2"><a href="">Download Sample Aqui</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-warning">Você ainda não tem pedidos !!</div>
                @endforelse
            </div>
            <hr>

            <div class="col-12">
                {{ $userOrders->links() }}
            </div>
        </div>

    </div>

</div>

@endsection
