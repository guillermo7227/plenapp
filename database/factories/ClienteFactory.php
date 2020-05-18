<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName().' '.$faker->lastName(),
        'telefono' => $faker->phoneNumber(),
        'direccion' => $faker->address(),
        'pais' => $faker->countryCode(),
        'observaciones' => $faker->paragraph(),
        'user_id' => fn() => $faker->randomElement(App\User::all()->pluck('id')),
    ];
});

