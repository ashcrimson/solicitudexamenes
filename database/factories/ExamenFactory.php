<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Examen;
use Faker\Generator as Faker;

$factory->define(Examen::class, function (Faker $faker) {

    return [
        'paciente_id' => $this->faker->word,
        'diagnostico_id' => $this->faker->word,
        'fecha_programa' => $this->faker->date('Y-m-d H:i:s'),
        'user_solicita' => $this->faker->word,
        'user_realiza' => $this->faker->word,
        'fecha_realiza' => $this->faker->date('Y-m-d H:i:s'),
        'muestras' => $this->faker->word,
        'rutina_urgencia' => $this->faker->word,
        'notas' => $this->faker->text,
        'estado_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
    ];
});
