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
                ->constrained('job_board.companies')
                ->comment('FK desde companies');

            $table->foreignId('location_id')
<<<<<<< HEAD
                ->constrained('core.locations');

            $table->foreignId('contract_type_id')
                ->constrained('core.catalogues');

            $table->foreignId('sector_id')
                ->constrained('core.catalogues');

            $table->foreignId('working_day_id')
                ->constrained('core.catalogues');

            $table->foreignId('training_hours_id')
                ->constrained('core.catalogues');

            $table->foreignId('state_id')
                ->constrained('core.states');
=======
                ->constrained('authentication.locations')
                ->comment('FK desde locations');

            $table->foreignId('contract_type_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->foreignId('sector_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->foreignId('working_day_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->foreignId('training_hours_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->foreignId('state_id')
                ->constrained('authentication.states')
                ->comment('FK desde states');
>>>>>>> 1ff8bf3648ca800014c8bc17d3bfc6d6093bcf34

            $table->foreignId('experience_time_id')
                ->constrained('authentication.catalogues')
                ->comment('FK desde catalogues');

            $table->string('code')->comment('Codigo de la oferta');

            $table->string('position')->comment('Nombre de la puesto');

            $table->string('contact_name')->comment('Nombre de la persona con quien se puede contactar');

            $table->string('contact_email')->comment('Email de la persona con quien se puede contactar');

            $table->string('contact_phone')->nullable()->comment('Telefono convencional de la persona con quien se puede contactar');

            $table->string('contact_cellphone')->nullable()->comment('Celular de la persona con quien se puede contactar');

            $table->string('remuneration')->nullable()->comment('Remuneracion ofrecida');

            $table->integer('vacancies')
                ->comment('total puestos disponibles')
                ->nullable();

            $table->date('start_at')->comment('Fecha de publicacion de la oferta');

            $table->date('end_at')->comment('Fecha en que se remueve la oferta');

            $table->json('activities')->comment('Actividades o responsabilidades del puesto');

            $table->json('requirements')->comment('Requisitos para postular para el puesto');

            $table->text('additional_information')
                ->nullable()
                ->comment('Informacion adicional sobre el puesto');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('offers');
    }
}
