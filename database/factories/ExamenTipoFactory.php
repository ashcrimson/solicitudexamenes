<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ExamenTipo;
use Faker\Generator as Faker;

$autoIncrement = autoIncrementFaker();

$factory->define(ExamenTipo::class, function (Faker $faker) use ($autoIncrement){

    $autoIncrement->next();

    return [
        'grupo_id' => \App\Models\ExamenGrupo::all()->random()->id,
        'codigo' => "codigo ".$autoIncrement->current(),
        'nombre' => "Examen ".$autoIncrement->current(),
        'rutina_emergencia' => $faker->randomElement(['rutina', 'emergencia' , 'ambas']),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
    ];
});
