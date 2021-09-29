<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardOfferProfessionalTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('offer_professional', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals')
                ->comment('FK desde professionals');

            $table->foreignId('offer_id')
                ->constrained('job_board.offers')
                ->comment('FK desde offers');

            $table->foreignId('state_id')
                ->nullable()
                ->constrained('core.states')
                ->comment('FK desde states');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('offer_professional');
    }
}