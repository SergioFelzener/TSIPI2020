<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['reference', 'pagseguro_code', 'pagseguro_status', 'store_id', 'itens'];
    // qual usuario a order em questao se refere
    public function user(){
        return $this->belongsTo(User::class);
    }
    // qual loja a order em questao se refere
    public function store(){
        return $this->belongsTo(store::class);
    }

    public function stores(){
                                                // passando tabledas de referencias com seus devidos nomes no db
        return $this->belongsToMany(store::class, 'order_store', 'order_id');
    }
}
