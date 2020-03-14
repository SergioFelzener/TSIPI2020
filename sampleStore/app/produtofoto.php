<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produtofoto extends Model
{

    protected $fillable =['image'];

    public function protudo(){

        return $this->belongsTo(produto::class);
    }
}
