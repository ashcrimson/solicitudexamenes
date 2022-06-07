<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('id_ext')->nullable();
            $table->string('tipo_ext')->nullable();
            $table->string('codubic')->nullable();
            $table->string('nropiso')->nullable();
            $table->string('nropieza')->nullable();
            $table->string('tipocama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn('id_ext');
            $table->dropColumn('tipo_ext');
            $table->dropColumn('codubic');
            $table->dropColumn('nropiso');
            $table->dropColumn('nropieza');
            $table->dropColumn('tipocama');
        });
    }
}
