<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardSkillsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('skills', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals')
                ->comment('FK desde professionals');

            $table->foreignId('type_id')
                ->comment('soft or hard')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->text('description')
            ->comment('descripcion');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('skills');
    }
}
