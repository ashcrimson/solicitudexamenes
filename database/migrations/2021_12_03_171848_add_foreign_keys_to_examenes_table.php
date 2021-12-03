<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examenes', function (Blueprint $table) {
            $table->foreign('user_solicita', 'fk_examenes_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('diagnostico_id', 'fk_examenes_diagnosticos1')->references('id')->on('diagnosticos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('paciente_id', 'fk_examenes_pacientes1')->references('id')->on('pacientes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_realiza', 'fk_examenes_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('estado_id', 'fk_examenes_examen_estados1')->references('id')->on('examen_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examenes', function (Blueprint $table) {
            $table->dropForeign('fk_examenes_users');
            $table->dropForeign('fk_examenes_diagnosticos1');
            $table->dropForeign('fk_examenes_pacientes1');
            $table->dropForeign('fk_examenes_users1');
            $table->dropForeign('fk_examenes_examen_estados1');
        });
    }
}
