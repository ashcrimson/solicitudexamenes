<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposHasExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_has_examen', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_id')->index('fk_tipos_has_examen_idx1');
            $table->unsignedBigInteger('examen_id')->index('fk_tipos_has_examen_idx2');
            $table->unsignedBigInteger('muestra_id')->index('fk_tipos_has_examen_idx3');
            $table->primary(['tipo_id', 'examen_id'],'pk_tipos_has_examen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_has_examen');
    }
}
