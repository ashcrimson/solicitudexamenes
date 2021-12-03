<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTiposHasExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipos_has_examen', function (Blueprint $table) {
            $table->foreign('tipo_id', 'fk_examen_tipos_has_examenes_examen_tipos1')->references('id')->on('examen_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('examen_id', 'fk_examen_tipos_has_examenes_examenes1')->references('id')->on('examenes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos_has_examen', function (Blueprint $table) {
            $table->dropForeign('fk_examen_tipos_has_examenes_examen_tipos1');
            $table->dropForeign('fk_examen_tipos_has_examenes_examenes1');
        });
    }
}
