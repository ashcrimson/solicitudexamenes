<?php

namespace Database\Seeders;

use App\Models\ExamenGrupo;
use Illuminate\Database\Seeder;

class ExamenGruposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('examen_grupos')->delete();

        factory(ExamenGrupo::class,1)->create(['nombre' => 'AUTOINMUNIDAD']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'BIOLOGIA MOLECULAR']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'COAGULACION']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'HEMATOLOGIA']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'MICROBIOLOGIA']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'QUIMICA/INMUNOLOGIA']);
        factory(ExamenGrupo::class,1)->create(['nombre' => 'VARIOS']);

    }
}
