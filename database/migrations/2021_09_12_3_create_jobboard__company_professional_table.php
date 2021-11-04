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
                ->comment('FK desde companies')
                ->constrained('job_board.companies');

            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->foreignId('state_id')
                ->nullable()
                ->comment('FK desde professionals')
                ->constrained('core.states');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('company_professional');
    }
}
