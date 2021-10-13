<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('enrollment_id')
                ->constrained('uic.enrollments')
                ->comment('Inscripción');

            $table->foreignId('project_plan_id')
                ->constrained('uic.project_plans')
                ->comment('Plan de proyecto');

            $table->string('title')
                ->comment('titulo');

            $table->string('description')
                ->comment('Descripcion');

            $table->integer('score')
                ->comment('Puntaje');

            $table->boolean('approved')
                ->comment('Aprobado');

            $table->string('total_advance')
                ->default(0)
                ->comment('Avance');

            $table->string('tutor_asigned')
                ->default(false)
                ->comment('Tutor asignado');

            $table->json('observations')
                ->nullable()
                ->comment('Observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('projects');
    }
}
