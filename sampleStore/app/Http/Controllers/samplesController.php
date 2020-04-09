<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sample;
use App\produto;

class samplesController extends Controller
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

        return view('samples', compact('produtos'));

    }
}
