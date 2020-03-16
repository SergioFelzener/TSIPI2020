<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storerequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;


class storecontroller extends Controller
{
    use UploadTrait;

    public function __construct(){
       $this->middleware('user.has.store')->only(['create', 'store']);
    }
    public function index()
    {
    	$store = auth()->user()->store;

    	return view('admin.stores.index', compact('store'));
    }

    public function create(){

        $users = \App\User::all(['id', 'name']);
        return view('admin.stores.create', compact('users'));
    }

    public function store(storerequest $request){


       // dd($request->all());
       $data = $request->all();
       $user = auth()->user();

       if($request->hasFile('logo')){
           $data['logo'] = $this->imageUpload($request->file('logo'));

       }

       $store = $user->store()->create($data);

       flash('Loja Criada com sucesso')->success();
        return redirect ()->route('admin.stores.index');

    }

    public function edit($store){

        $store = \App\store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(storerequest $request, $store){

     $data = ($request->all());
     $store = \App\store::find($store);

     if($request->hasFile('logo')){
        if(Storage::disk('public')->exists($store->logo)){
            Storage::disk('public')->delete($store->logo);
        }

        $data['logo'] = $this->imageUpload($request->file('logo'));

    }
     $store->update($data);

     flash('Loja Atualizada com sucesso')->success();
     return redirect ()->route('admin.stores.index');
    }

    public function destroy($store){

        $store = \App\store::find($store);
        $store->delete();

        flash('Loja removida com sucesso')->success();
        return redirect ()->route('admin.stores.index');
    }






}

