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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals')
                ->comment('Numero de profesional');


            $table->foreignId('type_id')
                ->comment('tipo de evento')
                ->constrained('core.catalogues');

            $table->foreignId('certification_type_id')
<<<<<<< HEAD
                ->constrained('core.catalogues');

            $table->foreignId('area_id')
                ->constrained('core.catalogues');
=======
                ->constrained('authentication.catalogues')
                ->comment('Verificar numero de certificado');


            $table->foreignId('area_id')
                ->constrained('authentication.catalogues')
                ->comment('Identificador de area');


            $table->text('name')
            ->comment('Nombre del curso');
>>>>>>> 1ff8bf3648ca800014c8bc17d3bfc6d6093bcf34

            $table->text('description')
                ->nullable()
                ->comment('Descripcion');


            $table->date('start_at')
            ->comment('13 de septiembre del 2021');


            $table->date('end_at')
            ->comment('Fecha final');


            $table->integer('hours')
            ->comment('Horas');

            $table->string('institution')
            ->comment('Institucion en la que se llevo o lleva el curso');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('courses');
    }
}
