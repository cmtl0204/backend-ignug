<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCategoryOfferTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('category_offer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('category_id')
                ->comment('FK desde categories')
                ->constrained('job_board.categories');

            $table->foreignId('offer_id')
                ->comment('FK desde offers')
                ->constrained('job_board.offers');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('category_offer');
    }
}
