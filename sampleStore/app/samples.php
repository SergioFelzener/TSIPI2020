<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class samples extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function store(){
        return $this->belongsTo(store::class);
    }

    public function categorias(){
        return $this->belongsToMany(categoria::class);
    }

    public function fotos(){
        return $this->hasMany(produtofoto::class);
    }

    public function audio(){
        return $this->hasOne(produtoaudio::class);
    }

}

