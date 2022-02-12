<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Diagnostico;
use App\Models\Examen;
use App\Models\ExamenEstado;
use App\Models\Paciente;
use App\Models\Role;
use App\Models\User;
use Faker\Generator as Faker;

$autoIncrement = autoIncrementFaker();

$factory->define(Examen::class, function (Faker $faker) use ($autoIncrement){

    $autoIncrement->next();

    return [
        'paciente_id' => Paciente::all()->random()->id,
        'diagnostico_id' => Diagnostico::all()->random()->id,
        'user_solicita' => User::role(['Medico'])->get()->random()->id,
        'user_realiza' => User::role(['Técnico Laboratorio'])->get()->random()->id,
        'fecha_realiza' => $faker->date('Y-m-d H:i:s'),
        'rutina_urgencia' => $faker->randomElement(['rutina', 'urgencia' , 'ambas']),
        'notas' => $faker->text,
        'estado_id' => $faker->randomElement([ExamenEstado::INGRESADO,ExamenEstado::SOLICITADO,ExamenEstado::PROGRAMADO]),
        'fecha_programa' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
