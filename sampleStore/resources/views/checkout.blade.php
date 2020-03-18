@extends('layouts.front')

@section('content')


    <div class="container">
        <h2>Dados para pagamento</h2>
        <hr>
            <div class="col-md-6">
                <form action="" method="POST">
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

                <button class="btn btn-lg btn-success processCheckout">Efetuar pagamento</button>

                </form>
            </div>
    </div>


@endsection

@section('scripts')

<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="{{asset('assets/js/jquery.ajax.js')}}"></script>

<script>

    const sessionId ='{{session()->get('pagseguro_session_code')}}'
    PagSeguroDirectPayment.setSessionId(sessionId);

</script>

<script>

    let amountTransaction = '{{$cartItens}}'
    let cardNumber = document.querySelector('input[name=card_number]');
    let spanBrand = document.querySelector('span.brand');
    cardNumber.addEventListener('keyup', function(){
           //console.log(cardNumber.value);
        if(cardNumber.value.length >= 6){
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.value.substr(0,6),
                success: function(res){
                    let imgFlag =`<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                    spanBrand.innerHTML = imgFlag;
                    document.querySelector('input[name=card_brand]').value = res.brand.name;

                    OpcoesDeParcelamento(amountTransaction, res.brand.name);
                    //console.log(res);
                  },
                error: function(err){
                    console.log(err);
                },
                complete: function(res){
                   // console.log('Complete: ', res);
                }
           });
        }
     });

     let submitButton = document.querySelector('button.processCheckout');
     submitButton.addEventListener('click', function(event){

         event.preventDefault();

         PagSeguroDirectPayment.createCardToken({
             cardNumber:    document.querySelector('input[name=card_number]').value,
             brand:         document.querySelector('input[name=card_brand]').value,
             cvv:           document.querySelector('input[name=card_cvv]').value,
             expirationMonth:document.querySelector('input[name=card_month]').value,
             expirationYear: document.querySelector('input[name=card_year]').value,
             success: function(res){
                 processPayment(res.card.token);
             }
         });
     });

     function processPayment(token){

        let data = {
            card_token: token,
            hash: PagSeguroDirectPayment.getSenderHash(),
            installment: document.querySelector('.seletorDeParcelamento').value,
            card_name: document.querySelector('input[name=card_name]').value,
            _token: '{{csrf_token()}}'
        };

         $.ajax({

            type: 'POST',
            url: '{{route("checkout.proccess")}}',
            data: data,
            dataType: 'json',
            success: function(res){
                console.log(res);
            }

         });
     }


     function OpcoesDeParcelamento (amount, brand) {

         PagSeguroDirectPayment.getInstallments({
            amount: amount,
            brand: brand,
            maxInstallmentNoInterest: 0,
            success: function(res){
                let opcoesDeParcelamento = DesenhaSelectComOpcoesDeParcelamento(res.installments[brand]);
                document.querySelector('div.installments').innerHTML = opcoesDeParcelamento;
                //console.log(res);

            },
            error: function(err){

               // console.log(err);

            },
            complete: function(res){

            },
        });

    }

    function DesenhaSelectComOpcoesDeParcelamento(installments) {
		let select = '<label>Opções de Parcelamento: </label>';

		select += '<select class="form-control seletorDeParcelamento">';

		for(let l of installments) {
		    select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
		}


		select += '</select>';

		return select;
	}



</script>


@endsection
