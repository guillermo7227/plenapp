<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Seguimiento::class, function (Faker $faker) {
    return [
        'cliente_id' => fn() => factory('App\Cliente')->create()->id,
        'fecha_compra' => $faker->date(),
        'fecha_seguimiento' => $faker->date(),
        'observaciones' => $faker->paragraph()
    ];
});

