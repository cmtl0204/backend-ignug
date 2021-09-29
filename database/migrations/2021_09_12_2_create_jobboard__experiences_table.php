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

            $table->foreignId('area_id')
                ->constrained('core.catalogues');

            $table->foreignId('professional_id')
                ->constrained('job_board.professionals');

            $table->json('activities');

            $table->string('employer');

            $table->date('end_date')
                ->nullable();

            $table->string('position');

            $table->text('reason_leave')
                ->nullable();

            $table->date('start_date');

            $table->boolean('worked')
                ->default(false);
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('experiences');
    }
}
