<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\store;


class CheckoutController extends Controller
{
    public function index(){

        // session()->forget('pagseguro_session_code');

        if(!auth()->check()){
            return redirect()->route('login');
        }

        if (!session()->has('cart')) return redirect()->route('home');

        $this->makePagSeguroSession();

       $total =0;
       $cartItens = array_map(function($line){
            return $line['amount'] * $line['price'];
       }, session()->get('cart'));

       $cartItens = array_sum($cartItens);


       var_dump(session()->get('pagseguro_session_code'));

    //    session()->forget('pagseguro_session_code');

       return view ('checkout', compact('cartItens'));
    }

    public function proccess(Request $request){

        try{
            $dataPost = $request->all();

            $reference = "xpto";
            //Instantiate a new direct payment request, using Credit Card
            $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

            $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $creditCard->setReference($reference);

            // Set the currency
            $creditCard->setCurrency("BRL");

            $cartItens = session()->get('cart');

            $stores = array_unique(array_column($cartItens, 'store_id'));


            foreach($cartItens as $item){
                // Add an item for this payment request
                $creditCard->addItems()->withParameters(
                    $reference,
                    $item['name'],
                    $item['amount'],
                    $item['price']
                );

            }

            $user = auth()->user();
            $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'text@sandbox.pagseguro.com.br' : $user->email;

            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $creditCard->setSender()->setName($user->name);
            $creditCard->setSender()->setEmail($email);

            $creditCard->setSender()->setPhone()->withParameters(
                11,
            56273440
            );

            $creditCard->setSender()->setDocument()->withParameters(
                'CPF',
                '23882769262'
            );

            $creditCard->setSender()->setHash($dataPost['hash']);

            $creditCard->setSender()->setIp('127.0.0.0');

            // Set shipping information for this payment request
            $creditCard->setShipping()->setAddress()->withParameters(
                'Av. Brig. Faria Lima',
                '1384',
                'Jardim Paulistano',
                '01452002',
                'São Paulo',
                'SP',
                'BRA',
                'apto. 114'
            );

            //Set billing information for credit card
            $creditCard->setBilling()->setAddress()->withParameters(
                'Av. Brig. Faria Lima',
                '1384',
                'Jardim Paulistano',
                '01452002',
                'São Paulo',
                'SP',
                'BRA',
                'apto. 114'
            );

            // Set credit card token
            $creditCard->setToken($dataPost['card_token']);

            list($quantity,$installmentAmount) = explode('|', $dataPost['installment']);
            // Set the installment quantity and value (could be obtained using the Installments
            // service, that have an example here in \public\getInstallments.php)
            $installmentAmount = number_format($installmentAmount, 2, '.', '');
            $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

            // Set the credit card holder information
            $creditCard->setHolder()->setBirthdate('01/10/1979');
            $creditCard->setHolder()->setName($dataPost['card_name']); // Equals in Credit Card

            $creditCard->setHolder()->setPhone()->withParameters(
                11,
                56273440
            );

            $creditCard->setHolder()->setDocument()->withParameters(
                'CPF',
                '23882769262'
            );

            // Set the Payment Mode for this payment request
            $creditCard->setMode('DEFAULT');

            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $result = $creditCard->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            // var_dump($result);
            $userOrder = [
                'reference'=> $reference,
                'pagseguro_code'=> $result->getCode(),
                'pagseguro_status'=> $result->getStatus(),
                'itens'=> serialize($cartItens),
                'store_id'=> 1
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            // notificar loja de novo pedido

            $store = (new Store())->notifyStoreOwners($stores);


            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data'=> [
                    'status'=> true,
                    'message' => 'Pedido Criado com sucesso',
                    'order' => $reference
                ]
            ]);

        } catch (\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage(): 'Erro ao processar pedido!';

            return response()->json([
                'data'=> [
                    'status'=> false,
                    'message' => $message
                ]
            ],401);

        }

    }

    public function thanks(){
        return view('thanks');
    }

    private function makePagSeguroSession (){

        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());

        }

    }
}
