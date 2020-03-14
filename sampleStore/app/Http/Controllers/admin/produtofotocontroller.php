<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\produtofoto;
use Illuminate\Http\Request;


class produtofotocontroller extends Controller
{
    public function removefoto($fotonome){
        //verificando se a imagem esta no arquivo
        if(Storage::disk('public')->exists($fotonome)){
            Storage::disk('public')->delete($fotonome);
        }
        // removendo do banco
        $removefoto = produtofoto::where('image', $fotonome);
        $removefoto->delete();

    }
}
