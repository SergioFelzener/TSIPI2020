<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produto extends Model{


    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    public function store(){
        return $this->belongsTo(store::class);
    }

    public function categorias(){
        return $this->belongsToMany(categoria::class);
    }

    public function fotos(){
        return $this->hasMany(produtofoto::class);
    }

}
