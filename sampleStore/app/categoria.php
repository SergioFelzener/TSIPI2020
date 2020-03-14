<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model{

    protected $fillable = ['name','categoria', 'slug'];

    public function produtos(){
        return $this->belongsToMany(produto::class);
    }

}
