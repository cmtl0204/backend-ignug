<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCompaniesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('activity_type_id')
                ->constrained('core.catalogues');

            $table->foreignId('person_type_id')
                ->comment('NATURAL O JURIDICA')
                ->constrained('core.catalogues');

            $table->foreignId('type_id')
                ->comment('PUBLICA, PRIVADA, MIXTA')
                ->constrained('core.catalogues');

            $table->foreignId('user_id')
                ->comment('FK desde users')
                ->constrained('authentication.users');

            $table->json('commercial_activities')
                ->comment('Array de actividades comerciales')
                ->nullable();

            $table->text('trade_name')
                ->comment('Nombre comercial de la compañia');

            $table->string('web')
                ->nullable()
                ->comment('Nombre o direccion de la web de la compañia');
        });
    }


    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('companies');
    }
}
