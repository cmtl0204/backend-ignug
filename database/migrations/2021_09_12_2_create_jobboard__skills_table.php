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
            $table->timestamps();
            $table->softDeletes();


            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->foreignId('type_id')
                ->comment('soft or hard')
                ->constrained('core.catalogues');

            $table->text('description')
            ->comment('descripcion');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('skills');
    }
}
