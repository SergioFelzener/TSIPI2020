<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produtoaudio extends Model
{
    protected $fillable = ['audio'];

    public function produtoaudio(){
        return $this->belongsTo(produto::class);
    }
}
