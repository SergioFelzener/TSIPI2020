<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserOrder;

class OrdersController extends Controller
{

    private $order;

    public function __construct(UserOrder $order){

        $this->order = $order;

    }

    public function index (){

        $orders = auth()->user()->store->orders()->paginate(10);

        //dd($orders);

        return view('admin.orders.index', compact('orders'));
    }


}
