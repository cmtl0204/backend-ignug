<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicProjectPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('project_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('title')
                ->comment('Título');

            $table->string('description')
                ->comment('Descripción');

            $table->string('act_code')
                ->comment('Código de acta');

            $table->date('approval_date')
                ->comment('Fecha de aprobación');

            $table->boolean('approved')
                ->comment('Esta aprovado');

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
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('project_plans');
    }
}
