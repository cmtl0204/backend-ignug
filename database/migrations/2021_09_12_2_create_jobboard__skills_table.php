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
<<<<<<< HEAD
                ->constrained('core.catalogues');
=======
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');
>>>>>>> 1ff8bf3648ca800014c8bc17d3bfc6d6093bcf34

            $table->text('description')
            ->comment('descripcion');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('skills');
    }
}
