<?php

namespace Database\Seeders;

use App\Models\DocumentoTipo;
use Illuminate\Database\Seeder;

class DocumentoTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentoTipo::firstOrCreate(['nombre' => 'NN']);
        DocumentoTipo::firstOrCreate(['nombre' => 'RUT']);
        DocumentoTipo::firstOrCreate(['nombre' => 'PASAPORTE']);
        DocumentoTipo::firstOrCreate(['nombre' => 'RECIEN NACIDO']);
    }
}
