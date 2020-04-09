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
        $produtoData = $request->get('produto');

        $produto = \App\produto::whereSlug($produtoData['slug']);

        //dd($produto->count());
        // nao deixar o usuario alterar nossos formularios que estao em hidden
        if(!$produto->count() || $produtoData['amount'] <= 0)
            return redirect()->route('home');

        $produto = array_merge($produtoData, $produto->first(['name', 'price', 'store_id'])->toArray());


        //dd($produto);
        // verificando se existe sessao para os produtos
        if(session()->has('cart')){

            $produtos = session()->get('cart');
            $produtosSlugs = array_column($produtos, 'slug');

            // se tiver produto com mesmo slug na sessaco vamos  incrementar
            // a quantidade de intens desse novo produto com a quantidade de
            // itens com a quantidade que esta vindo da requisicao vou ter
            // um array novo modificado por meio do array map
            if(in_array($produto['slug'], $produtosSlugs)){

                $produtos = $this->protutoIncrement($produto['slug'], $produto['amount'],$produtos);

                session()->put('cart', $produtos);

            } else {

                session()->push('cart', $produto);

            }

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

    private function protutoIncrement($slug, $amount, $produtos){

        $produtos = array_map(function($line) use($slug, $amount) {
            // quando a linha do slug for igual a linha do produto da sessao incrementa o valor do amount
            if($slug == $line['slug']) {

                //adicionando novo amounte caso venha em duplicidade
                $line['amount'] += $amount;
            }
            return $line;

        }, $produtos);

        // retornando array alterado

        return $produtos;

    }

}
