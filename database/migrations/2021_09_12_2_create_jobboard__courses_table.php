<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCoursesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('area_id')
                ->constrained('core.catalogues');

            $table->foreignId('certification_type_id')
                ->constrained('core.catalogues');

            $table->foreignId('professional_id')
                ->comment('Numero de profesional')
                ->constrained('job_board.professionals');

            $table->foreignId('type_id')
                ->comment('tipo de evento')
                ->constrained('core.catalogues');

            $table->text('description')
                ->nullable()
                ->comment('Descripcion');

            $table->integer('hours')
                ->comment('Horas');

            $table->date('ended_at')
                ->comment('Fecha final');

            $table->string('institution')
                ->comment('Institucion en la que se llevo o lleva el curso');

            $table->text('name')
                ->comment('Nombre del curso');

            $table->date('started_at')
                ->comment('13 de septiembre del 2021');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('courses');
    }
}
