<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\categoria;
use Faker\Generator as Faker;

$factory->define(categoria::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->sentence,
        'slug'=>$faker->slug,
    ];
});
