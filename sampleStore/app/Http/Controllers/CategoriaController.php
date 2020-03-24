<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categoria;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(categoria $categoria){

        $this->categoria = $categoria;

    }

    public function index($slug){

        $categoria = $this->categoria->whereSlug($slug)->first();

        return view('categoria', compact('categoria'));
    }
}
