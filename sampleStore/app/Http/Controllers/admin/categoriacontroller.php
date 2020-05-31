<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\categoria;
use App\Http\Requests\categoriarequest;
use App\Traits\UploadTrait;

class categoriacontroller extends Controller
{
	/**
	 * @var categoria
	 */

    use UploadTrait;

	private $categoria;

	public function __construct(categoria $categoria)
	{
		$this->categoria = $categoria;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $categorias = $this->categoria->paginate(10);

	    return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('admin.categorias.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param categoriarequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(categoriarequest $request)
    {
        $data = $request->all();

        if($request->hasFile('img')){
            $data['img'] = $this->imageUpload($request->file('img'));
        }

	    $categoria = $this->categoria->create($data);

	    flash('Categoria Criado com Sucesso!')->success();
	    return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($categoria)
    {
	    $categoria = $this->categoria->findOrFail($categoria);

	    return view('admin.categorias.edit', compact('categoria'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param categoriarequest $request
	 * @param  int $categoria
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(categoriarequest $request, $categoria)
    {
        $data = $request->all();

        $categoria = $this->categoria->find($categoria);

        if($request->hasFile('img')){
            if(Storage::disk('public')->exists($categoria->img)){
                Storage::disk('public')->delete($categoria->img);
            }

            $data['img'] = $this->imageUpload($request->file('img'));

        }

	    $categoria->update($data);

	    flash('Categoria Atualizada com Sucesso!')->success();
	    return redirect()->route('admin.categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoria)
    {
	    $categoria = $this->categoria->find($categoria);
	    $categoria->delete();

	    flash('Categoria Removida com Sucesso!')->success();
	    return redirect()->route('admin.categorias.index');
    }
}
