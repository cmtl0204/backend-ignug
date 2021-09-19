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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('area_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');


            $table->foreignId('professional_id')
                ->constrained('job_board.professionals')
                ->comment('FK desde professionals');


            $table->json('activities')
            ->comment('Actividades');


            $table->string('employer')
            ->comment('Empleador');


            $table->date('end_at')
                ->nullable()
                ->comment('Fecha final');


            $table->string('position')
            ->comment('Posicion');


            $table->text('reason_leave')
                ->nullable()
                ->comment('');


            $table->date('start_at')
            ->comment('Fecha de inicio');


            $table->boolean('worked')
                ->default(false);
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('experiences');
    }
}
