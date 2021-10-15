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
                ->comment('FK de status')
                ->constrained('app.careers');

            $table->string('name')->nullable()
                ->comment('Nombre');

            $table->string('description')->nullable()
                ->comment('Descripción');

            $table->date('started_at')
                ->comment('Fecha de inicio de la planeación');

            $table->date('ended_at')
                ->comment('Fecha del final de la planeación');

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
