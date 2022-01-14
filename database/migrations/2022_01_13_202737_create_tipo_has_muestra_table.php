<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoHasMuestraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_has_muestra', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_id')->index('fk_examen_tipos_has_muestras_examen_tipos1_idx');
            $table->unsignedBigInteger('muestra_id')->index('fk_examen_tipos_has_muestras_muestras1_idx');
            $table->primary(['tipo_id', 'muestra_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_has_muestra');
    }
}
