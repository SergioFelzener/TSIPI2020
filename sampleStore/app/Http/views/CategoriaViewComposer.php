<?php

namespace App\Http\views;

use App\categoria;

class CategoriaViewComposer {

    private $categoria;

    public function __construct(categoria $categoria){

        $this->categoria = $categoria;
    }


    public function compose($view){

        return $view->with('categorias', $this->categoria->all(['name', 'slug']));
    }

}
