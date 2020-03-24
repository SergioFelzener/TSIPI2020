<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\store;

class StoreController extends Controller
{
    private $store;

    public function __construct(store $store){

        $this->store = $store;

    }

    public function index($slug){

        $store = $this->store->whereSlug($slug)->first();

        //dd($store);

        return view ('store', compact('store'));

    }
}
