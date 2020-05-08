@extends('layouts.front')

@section('stylesheets')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection
@section('content')


    <div class="container-checkout">
        <h2>Pagamento</h2>
        <hr>
            <div class="col-md-6">
                <form class="form-checkout" action="" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Nome do Cartão</label>
                            <input type="text" class="form-control" name="card_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Numero do Cartão <span class="brand"></span></label>
                            <input type="text" class="form-control" name="card_number">
                            <input type="hidden" name="card_brand">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">Mes de Expiração</label>
                            <input type="text" class="form-control" name="card_month">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Ano de expiração</label>
                            <input type="text" class="form-control" name="card_year">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Código de segurança</label>
                            <input type="text" class="form-control" name="card_cvv">
                        </div>
                        <div class="col-md-12 installments form-group">

                        </div>
                    </div>

                <button class="btn-checkout">Efetuar pagamento</button>
                <a href="{{route('home')}}" class="btn-secondary">Cancelar</a>

                </form>
            </div>
    </div>


@endsection

@section('scripts')

<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>

    const sessionId ='{{session()->get('pagseguro_session_code')}}'
    const urlThanks = '{{route('checkout.thanks')}}';
    const urlProccess = '{{route("checkout.proccess")}}';
    const amountTransaction = '{{$cartItens}}';
    const csrf = '{{csrf_token()}}';

    PagSeguroDirectPayment.setSessionId(sessionId);

</script>

<script src="{{asset('js/pagseguro_functions.js')}}"></script>
<script src="{{asset('js/pagseguro_events.js')}}"></script>


@endsection
