<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExamenTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examen_tipos', function (Blueprint $table) {
            $table->foreign('grupo_id', 'fk_examen_tipos1')->references('id')->on('examen_grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examen_tipos', function (Blueprint $table) {
            $table->dropForeign('fk_examen_tipos1');
        });
    }
}
