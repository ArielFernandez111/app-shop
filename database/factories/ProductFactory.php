<?php

use Faker\Generator as Faker;
use App\Product;

//todos los metodos que faker pone a nuestra disposicion podemos encontrarlo en un repositorio de github con https://github.com/fzaninotto/Faker

$factory->define(Product::class, function (Faker $faker) {
    return [
        //quitaremos el ultimo caracter de la sentencia usando la funcion llamada substr (1er parametro que recibe es la cadena a procesar, el 2do parametro es desde que posicion queremos tomar la nueva cadena, es decir debemos indicarle que parte de la cadena queremos tomar : en este caso queremos tomar desde la posicion 0 hasta una posicion antes de la ultima posicion, entonces le ponemos -1)
        'name' => substr($faker->sentence(3), 0, -1),
        'description' => $faker->sentence(10),
        'long_description' => $faker->text,
        'price' => $faker->randomFloat(2, 5, 150),

        'category_id' => $faker->numberBetween(1, 5)
    ];
});
