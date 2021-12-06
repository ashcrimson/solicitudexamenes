<?php

namespace Database\Seeders;

use App\Models\ExamenEstado;
use Illuminate\Database\Seeder;

class ExamenEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('examen_estados')->delete();

        factory(ExamenEstado::class,1)->create(['nombre' => 'INGRESADO']);
        factory(ExamenEstado::class,1)->create(['nombre' => 'SOLICITADO']);
        factory(ExamenEstado::class,1)->create(['nombre' => 'PROGRAMADO']);
        factory(ExamenEstado::class,1)->create(['nombre' => 'REALIZADO']);
        factory(ExamenEstado::class,1)->create(['nombre' => 'ANULADO']);

    }
}
