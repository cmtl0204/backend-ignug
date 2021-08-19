<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardOffersTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('offers', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('company_id')
                ->constrained('job_board.companies');

            $table->foreignId('location_id')
                ->constrained('authentication.locations');

            $table->foreignId('contract_type_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('sector_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('working_day_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('training_hours_id')
                ->constrained('authentication.catalogues');

            $table->foreignId('state_id')
                ->constrained('authentication.states');

            $table->string('code');

            $table->string('position');

            $table->string('contact_name');

            $table->string('contact_email');

            $table->string('contact_phone')->nullable();

            $table->string('contact_cellphone')->nullable();

            $table->string('remuneration')->nullable();

            $table->foreignId('experience_time');

            $table->integer('vacancies')
                ->comment('total puestos disponibles')
                ->nullable();

            $table->date('start_date');

            $table->date('end_date');

            $table->json('activities');

            $table->json('requirements');

            $table->text('additional_information')->nullable();

        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('offers');
    }
}
