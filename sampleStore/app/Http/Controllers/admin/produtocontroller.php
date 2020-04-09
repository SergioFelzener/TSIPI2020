<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\produto;
use App\Http\Requests\produtorequest;
use App\Traits\UploadTrait;

class produtocontroller extends Controller
{
    use UploadTrait;

    private $produto;

    public function __construct(produto $produto){
        $this->produto = $produto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;
        $produtos = $userStore->produtos()->paginate(10);

        return view ('admin.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $categorias = \App\categoria::all(['id', 'name']);

        return view ('admin.produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(produtorequest $request)
    {

        $data = $request->all();

        $categorias = $request->get('categorias', null);

        $store = auth()->user()->store;
        $produto = $store ->produtos()->create($data);

        $produto->categorias()->sync($categorias);

        if($request->hasFile('fotos')) {
            $images = $this->imageUpload($request->file('fotos'), 'image');

            $produto->fotos()->createMany($images);
        }

        if($request->hasFile('audio')) {
            $audio = $this->audioUpload($request, 'audio');

            $produto->audio()->createMany($audio);
        }

        flash('produto criado com sucesso')->success();
        return redirect()->route('admin.produtos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($produto)
    {
        $produtos = $this->produto->findOrFail($produto);
        ($categorias = \App\categoria::all(['id', 'name']));

        return view ('admin.produtos.edit', compact('produtos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(produtorequest $request, $produto)
    {
        $data = $request->all();
        $categorias = $request->get('categorias', null);

        $produto = $this->produto->find($produto);
        $produto->update($data);

        if(!is_null($categorias)){
            $produto->categorias()->sync($categorias);
        }

        if($request->hasFile('fotos')) {
            $images = $this->imageUpload($request->file('fotos'), 'image');

            $produto->fotos()->createMany($images);
        }

        flash('produto atualizado com sucesso')->success();
        return redirect()->route('admin.produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($produto)
    {

        $produto = $this->produto->find($produto);
        $produto->delete();

        flash('produto removido com sucesso')->success();
        return redirect()->route('admin.produtos.index');
    }

    private function audioUpload(Request $request, $audioColumn){

        $audio = $request->file('audio');
        $uploadAudio =[];

        $uploadAudio [] = [$audioColumn => $audio->store('audio', 'public')];

        return $uploadAudio;
    }

}
