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
            $table->foreign('tipo_id', 'fk_tipos_has_examen1')->references('id')->on('examen_tipos');
            $table->foreign('examen_id', 'fk_tipos_has_examen2')->references('id')->on('examenes');
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
            $table->dropForeign('fk_tipos_has_examen1');
            $table->dropForeign('fk_tipos_has_examen2');
        });
    }
}
