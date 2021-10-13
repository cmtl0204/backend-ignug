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
                ->comment('FK de status: carrera');

            $table->string('name')->nullable()
                ->comment('nombre');

            $table->date('start_date')
                ->comment('fecha de inicio');

            $table->date('end_date')
                ->comment('fecha fin');

            $table->string('description')->nullable()
                ->comment('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DB_CONNECTION_UIC')->dropIfExists('plannings');
    }
}
