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
                ->constrained('job_board.professionals');;

            $table->foreignId('type_id')
                ->comment('tipo de evento')
                ->constrained('authentication.catalogues');

            $table->foreignId('institution_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('certification_type_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('area_id')
                ->constrained('authentication.catalogues');

            $table->text('name');

            $table->text('description')
                ->nullable();

            $table->date('start_date');

            $table->date('end_date');

            $table->integer('hours');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('courses');
    }
}
