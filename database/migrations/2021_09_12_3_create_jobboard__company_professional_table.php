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
                ->constrained('job_board.companies');
                ->comment('FK desde companies');

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals');
                ->comment('FK desde professionals');

            $table->foreignId('state_id')
                ->nullable()
                ->constrained('authentication.states');
                ->comment('FK desde states');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('company_professional');
    }
}