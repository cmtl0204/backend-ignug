<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardExperiencesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('experiences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('area_id')
                ->constrained('core.catalogues');

            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->json('activities')
                ->comment('Actividades');


            $table->string('employer')
                ->comment('Empleador');


            $table->date('ended_at')
                ->nullable()
                ->comment('Fecha final');

            $table->string('position')
                ->comment('Posicion');

            $table->text('reason_leave')
                ->nullable()
                ->comment('Motivo de renuncia');

            $table->date('started_at')
                ->comment('Fecha de inicio');

            $table->boolean('worked')
                ->default(false)
                ->comment('Para saber si continua trabajando o no; true=ya no trabaja');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('experiences');
    }
}
