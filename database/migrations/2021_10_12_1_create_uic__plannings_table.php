<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicPlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('plannings', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('career_id')
                ->comment('FK de status: carrera')
                ->constrained('app.careers');

            $table->string('name')->nullable()
                ->comment('Nombre');

            $table->date('started_at')
                ->comment('Fecha de inicio');

            $table->date('ended_at')
                ->comment('Fecha fin');

            $table->string('description')->nullable()
                ->comment('Descripción');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('plannings');
    }
}
