<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class store extends Model{

    use HasSlug;

    protected $fillable = ['name','description', 'phone', 'slug', 'logo'];

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function user(){
        $this->belongsTo(User::class);
    }
    public function produtos(){
        return $this->hasMany(produto::class);
    }

    public function orders(){
        return $this->hasMany(UserOrder::class);
    }

}
