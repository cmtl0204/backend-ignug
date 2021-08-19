<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardLanguagesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('languages', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals');;

            $table->foreignId('idiom_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('written_level_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('spoken_level_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('read_level_id')
                ->constrained('authentication.catalogues');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('languages');
    }
}
