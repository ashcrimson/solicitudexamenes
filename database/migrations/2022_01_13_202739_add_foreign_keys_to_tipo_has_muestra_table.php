<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTipoHasMuestraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_has_muestra', function (Blueprint $table) {
            $table->foreign('tipo_id', 'fk_tipos_has_muestras1')->references('id')->on('examen_tipos');
            $table->foreign('muestra_id', 'fk_tipos_has_muestras2')->references('id')->on('muestras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_has_muestra', function (Blueprint $table) {
            $table->dropForeign('fk_tipos_has_muestras1');
            $table->dropForeign('fk_tipos_has_muestras2');
        });
    }
}
