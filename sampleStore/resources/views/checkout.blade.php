@extends('layouts.front')

@section('content')


    <div class="container">
        <h2>Dados para pagamento</h2>
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Numero do Cartão</label>
                            <input type="text" class="form-control" name="card_number">
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
                        <div class="form-group col-md-5">
                            <label for="">Código de segurança</label>
                            <input type="text" class="form-control" name="card_cvv">
                        </div>
                    </div>

                <button class="btn btn-lg btn-success">Efetuar pagamento</button>

                </form>
            </div>
    </div>


@endsection

@section('scripts')

<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script>

    const sessinoId = '{{session()->get('pagseguro_session_code')}}'
    PagSeguroDirectPayment.setSessionId(sessionId);

</script>

<script>

    let cardNumber = document.querySelector('input[name=card_number]');
        cardNumber.addEventListener('keyup', function(){
            if(cardNumber.value.length >= 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0,6),
                    success: function(res){
                        console.log(res);
                    },
                    error: function(err){
                        console.log(err);
                    },
                    complete: function(res){
                        console.log('Complete: ', res);
                    }
                });
            }
        });



</script>


@endsection
