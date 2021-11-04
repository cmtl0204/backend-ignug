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

            $table->foreignId('offer_id')
                ->comment('FK desde offers')
                ->constrained('job_board.offers');

            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->foreignId('state_id')
                ->nullable()
                ->comment('FK desde states')
                ->constrained('core.states');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('offer_professional');
    }
}
