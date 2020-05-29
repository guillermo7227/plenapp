<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Seguimiento::class, function (Faker $faker) {
    $fecha_compra = $faker->date();
    return [
        'cliente_id' => fn() => factory('App\Cliente')->create()->id,
        'fecha_compra' => $fecha_compra,
        'fecha_seguimiento' => $fecha_compra->addDays(14),
        'fecha_seguimiento' => $fecha_compra->addDays(28),
        'observaciones' => $faker->paragraph()
    ];
});

