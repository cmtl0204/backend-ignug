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
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('career_id')
                ->comment('FK desde core.careers')
                ->constrained('core.careers');

            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->foreignId('professional_degree_id')
                ->comment('FK desde categories')
                ->constrained('job_board.categories');

            $table->boolean('certificated')
                ->default(false)
                ->comment('Para saber si posee certificado;True=tiene false=no tiene');

            $table->date('registered_at')
                ->nullable()
                ->comment('Fecha del registro');

            $table->string('senescyt_code')
                ->nullable()
                ->comment('Codigo de senescyt');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('academic_formations');
    }
}
