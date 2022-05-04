<?php

namespace Database\Seeders;

use App\Models\ExamenEstado;
use Illuminate\Database\Seeder;

class ExamenEstadosTable2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExamenEstado::firstOrCreate(['nombre' => 'ELIMINADO']);
    }
}
