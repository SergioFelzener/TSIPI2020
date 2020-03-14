<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store extends Model{

    protected $fillable = ['name','description', 'phone', 'slug', 'logo'];


    public function user(){
        $this->belongsTo(User::class);
    }
    public function produtos(){
        return $this->hasMany(produto::class);
    }

}
