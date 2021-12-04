<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id')->index('fk_examene_pacientes1_idx');
            $table->unsignedBigInteger('diagnostico_id')->index('fk_examene_diagnosticos1_idx');
            $table->dateTime('fecha_programa')->nullable();
            $table->unsignedBigInteger('user_solicita')->index('fk_examene_users_idx');
            $table->unsignedBigInteger('user_realiza')->index('fk_examene_users1_idx');
            $table->dateTime('fecha_realiza')->nullable();
            $table->string('muestras')->nullable();
            $table->string('rutina_urgencia')->nullable();
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('estado_id')->index('fk_examene_estados1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examenes');
    }
}
