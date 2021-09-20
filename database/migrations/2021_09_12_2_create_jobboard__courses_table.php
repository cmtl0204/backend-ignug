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
                ->constrained('authentication.catalogues');

            $table->foreignId('certification_type_id')
                ->constrained('authentication.catalogues')
                ->comment('Verificar numero de certificado');


            $table->foreignId('area_id')
                ->constrained('authentication.catalogues')
                ->comment('Identificador de area');


            $table->text('name')
            ->comment('Nombre del curso');

            $table->text('description')
                ->nullable()
                ->comment('Descripcion');


            $table->date('start_at')
            ->comment('13 de septiembre del 2021');


            $table->date('end_at')
            ->comment('Fecha final');


            $table->integer('hours')
            ->comment('Horas');

            $table->string('institution');

        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('courses');
    }
}
