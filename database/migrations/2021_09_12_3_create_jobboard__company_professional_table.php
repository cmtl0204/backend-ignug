<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCompanyProfessionalTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('company_professional', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('company_id')
                ->constrained('job_board.companies')
                ->comment('FK desde companies');

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals')
                ->comment('FK desde professionals');

            $table->foreignId('state_id')
                ->nullable()
<<<<<<< HEAD
                ->constrained('core.states');
=======
                ->constrained('authentication.states')
                ->comment('FK desde states');
>>>>>>> 1ff8bf3648ca800014c8bc17d3bfc6d6093bcf34
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('company_professional');
    }
}
