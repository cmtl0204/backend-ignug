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
                ->constrained('core.catalogues');

            $table->foreignId('certification_type_id')
                ->constrained('core.catalogues');

            $table->foreignId('area_id')
                ->constrained('core.catalogues');

            $table->text('description')
                ->nullable();

            $table->date('end_date');

            $table->integer('hours');

            $table->string('institution');

            $table->text('name');

            $table->date('start_date');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('courses');
    }
}
