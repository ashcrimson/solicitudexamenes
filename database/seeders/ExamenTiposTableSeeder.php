<?php

namespace Database\Seeders;

use App\Models\ExamenTipo;
use Illuminate\Database\Seeder;

class ExamenTiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('examen_tipos')->delete();


        factory(ExamenTipo::class,100)->create();

    }
}
