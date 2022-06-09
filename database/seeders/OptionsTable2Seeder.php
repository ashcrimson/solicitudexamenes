<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTable2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::firstOrCreate([
            'id' => 28,
            'option_id' => 15,
            'nombre' => 'Documento Tipos',
            'ruta' => 'documentoTipos.index',
            'descripcion' => NULL,
            'icono_l' => 'fa-circle-notch',
            'icono_r' => NULL,
            'orden' => 0,
            'color' => 'bg-teal',
            'dev' => 0,
            'created_at' => '2022-06-09 11:49:00',
            'updated_at' => '2022-06-09 11:49:00',
            'deleted_at' => NULL,
        ]);
    }
}
