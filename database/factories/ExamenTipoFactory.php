<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ExamenTipo;
use Faker\Generator as Faker;

$factory->define(ExamenTipo::class, function (Faker $faker) {

    return [
        'grupo_id' => $this->faker->word,
        'codigo' => $this->faker->word,
        'nombre' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
    ];
});
