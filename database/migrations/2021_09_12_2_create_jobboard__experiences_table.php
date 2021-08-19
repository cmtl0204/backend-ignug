<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardExperiencesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('experiences', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals');

            $table->foreignId('area_id')
                ->constrained('authentication.catalogues');

            $table->string('employer');

            $table->string('position');

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            $table->json('activities');

            $table->text('reason_leave')
                ->nullable();

            $table->boolean('worked')
                ->default(false);
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('experiences');
    }
}
