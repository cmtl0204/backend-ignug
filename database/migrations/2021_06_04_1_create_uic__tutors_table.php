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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('project_plan_id')->nullable()->constrained('uic.project_plans');
            $table->foreignId('teacher_id')->comment('id de la tabla')->constrained('core.teachers');
            $table->foreignId('type_id')->comment('para saber si es tutor, revisor ,etc')->constrained('core.catalogues');
            $table->json('observations')->comment('registro de cambios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('tutors');
    }
}
