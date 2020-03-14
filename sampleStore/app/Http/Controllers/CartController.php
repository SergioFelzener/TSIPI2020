<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }
    public function add(Request $request) {
        $produto = $request->get('produto');

        //dd($produto);
        // verificando se existe sessao para os produtos
        if(session()->has('cart')){
            session()->push('cart', $produto);

        } else {

            $produtos[] = $produto;

            session()->put('cart', $produtos);

        }

        flash('Produto adicionado no carrinho')->success();
        return redirect()->route('produto.single', ['slug' => $produto['slug']]);


    }

    public function remove($slug){
        if(!session()->has('cart'))
            return redirect()->route('cart.index');

        $produtos = session()->get('cart');
        //
        $produtos = array_filter($produtos, function($line) use($slug){
            return $line['slug'] !=$slug;

        });

        session()->put('cart', $produtos);
        return redirect()->route('cart.index');
    }

    public function cancel(){
        session()->forget('cart');

        flash('Compra cancelada com sucesso')->success();
        return redirect()->route('cart.index');
    }
}
