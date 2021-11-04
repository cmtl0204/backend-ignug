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
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('contract_type_id')
                ->constrained('core.catalogues');

            $table->foreignId('company_id')
                ->comment('FK desde companies')
                ->constrained('job_board.companies');

            $table->foreignId('experience_time_id')
                ->comment('FK desde catalogues')
                ->constrained('core.catalogues');

            $table->foreignId('location_id')
                ->constrained('core.locations');

            $table->foreignId('sector_id')
                ->constrained('core.catalogues');

            $table->foreignId('state_id')
                ->constrained('core.states');

            $table->foreignId('training_hours_id')
                ->constrained('core.catalogues');

            $table->foreignId('working_day_id')
                ->constrained('core.catalogues');

            $table->json('activities')
                ->comment('Actividades o responsabilidades del puesto');

            $table->text('additional_information')
                ->nullable()
                ->comment('Informacion adicional sobre el puesto');

            $table->string('code')
                ->comment('Codigo de la oferta');

            $table->string('contact_cellphone')
                ->nullable()
                ->comment('Celular de la persona con quien se puede contactar');

            $table->string('contact_email')
                ->comment('Email de la persona con quien se puede contactar');

            $table->string('contact_name')
                ->comment('Nombre de la persona con quien se puede contactar');

            $table->string('contact_phone')
                ->nullable()
                ->comment('Telefono convencional de la persona con quien se puede contactar');

            $table->date('ended_at')
                ->comment('Fecha en que se remueve la oferta');

            $table->string('position')
                ->comment('Nombre de la puesto');

            $table->string('remuneration')
                ->nullable()
                ->comment('Remuneracion ofrecida');

            $table->date('started_at')
                ->comment('Fecha de publicacion de la oferta');

            $table->json('requirements')
                ->comment('Requisitos para postular para el puesto');

            $table->integer('vacancies')
                ->comment('total puestos disponibles')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('offers');
    }
}
