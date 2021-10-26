<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('tutors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('project_plan_id')
                ->comment('FK de project_plan')
                ->constrained('uic.project_plans')
                ->nullable();

            $table->foreignId('project_plan_id')
                ->comment('FK de teacher: id de la tabla')
                ->constrained('app.teachers');

            $table->foreignId('type_id')
                ->comment('FK de type: para saber si es tutor, revisor ,etc')
                ->constrained('core.catalogues');

            $table->json('observations')
                ->comment('registro de cambios')
                ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('tutors');
    }
}
