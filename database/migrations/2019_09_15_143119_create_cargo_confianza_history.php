<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoConfianzaHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('log_cargo_confianza', function (Blueprint $table) {
            /**
             * Datos de seguimiento de historial
             */
            $table->increments('historial_db_id');
            $table->timestamp('historial_db_created_at')->useCurrent();;
            $table->char('historial_db_operation', 1);

            /**
             * Datos de replica base de datos origen
             */
            $table->integer('id')->unsigned()->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('estado_cargo', 30)->nullable();
            $table->string('documento_adjunto', 100)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('log_cargo_confianza');
    }
}