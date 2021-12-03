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
            $table->unsignedBigInteger('tipo_id')->index('fk_examen_tipos_has_examenes_examen_tipos1_idx');
            $table->unsignedBigInteger('examen_id')->index('fk_examen_tipos_has_examenes_examenes1_idx');
            $table->primary(['tipo_id', 'examen_id']);
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
