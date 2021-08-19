<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardAcademicFormationsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('academic_formations', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals');

            $table->foreignId('professional_degree_id')
                ->constrained('job_board.categories');

            $table->date('registration_date')
                ->nullable();

            $table->string('senescyt_code')
                ->nullable();

            $table->boolean('certificated')
                ->default(false);
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('academic_formations');
    }
}
