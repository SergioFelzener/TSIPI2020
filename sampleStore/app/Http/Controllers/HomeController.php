<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produto;
use App\Http\Controllers\admin\produtocontroller;

class HomeController extends Controller
{
    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
        //dd($produto);
    }


    public function index()
    {
        $produtos = $this->produto->limit(12)->orderBy('id', 'DESC')->get();
        //dd($produtos);
        $stores = \App\store::limit(3)->orderBy('id', 'DESC')->get();

	    return view('welcome', compact('produtos', 'stores'));
    }

    public function single($slug){
        $produto = $this->produto->whereSlug($slug)->first();

        return view ('single', compact('produto'));

    }
}
