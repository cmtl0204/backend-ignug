<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicTutorShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('tutor_ships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('tutor_id')
                ->comment('FK de tutors')
                ->constrained('uic.tutors');

            $table->foreignId('enrollment_id')
                ->comment('FK de enrollments')
                ->constrained('uic.enrollments');

            $table->json('topics')->nullable()
                ->comment('Temas tratados en la tutoría');

            $table->date('started_at')->nullable()
                ->comment('Fecha de la tutoría');

            $table->time('time_started_at')
                ->comment('Hora de inicio de la tutoría');

            $table->time('time_ended_at')
                ->comment('Hora en que terminó latutoría');

            $table->time('duration')
                ->comment('Tiempo de duración de la tutoría');

            $table->integer('percentage_advance')
                ->nullable()
                ->comment('Porcentaje de avance de los temas tratados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('tutor_ships');
    }

}
