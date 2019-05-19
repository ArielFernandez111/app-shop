<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //ucfirst vuelve mayuscula a la primera letra del faker generado
        'name' => ucfirst($faker->word),
        'description' => $faker->sentence(10)
    ];
});
