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
            $table->foreign('tipo_id', 'fk_examen_tipos_has_muestras_examen_tipos1')->references('id')->on('examen_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('muestra_id', 'fk_examen_tipos_has_muestras_muestras1')->references('id')->on('muestras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_examen_tipos_has_muestras_examen_tipos1');
            $table->dropForeign('fk_examen_tipos_has_muestras_muestras1');
        });
    }
}
