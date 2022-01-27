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
            $table->unsignedBigInteger('tipo_id')->index('fk_tipos_has_muestras_idx1');
            $table->unsignedBigInteger('muestra_id')->index('fk_tipos_has_muestras_idx2');
            $table->primary(['tipo_id', 'muestra_id'],'pk_tipo_has_muestra');
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
