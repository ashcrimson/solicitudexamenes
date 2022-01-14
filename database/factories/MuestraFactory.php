<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Muestra;
use Faker\Generator as Faker;

$factory->define(Muestra::class, function (Faker $faker) {

    return [
        'codigo' => $this->faker->randomDigitNotNull,
        'nombre' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
    ];
});
