<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\produtofoto;
use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){

        $photoName = $request->get('photoName');

        if(Storage::disk('public')->exists($photoName)){
            Storage::disk('public')->delete($photoName);
        }
        // removendo do banco
        $removePhoto = produtofoto::where('image', $photoName);
        $productId = $removePhoto->first()->produto_id;

        $removePhoto->delete();

        flash('Imagem Removida Com Sucesso')->success();
        return redirect()->route('admin.produtos.edit', ['produto'=> $productId]);

    }
}
