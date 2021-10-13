<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('tutorships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('tutor_id')
                ->constrained('uic.tutors')
                ->comment('FK de tutors');

            $table->foreignId('enrollment_id')
                ->constrained('uic.enrollments')
                ->comment('FK de enrollments');

            $table->json('topics')->nullable()
                ->comment('Temas tratados en la tutoría');

            $table->date('started_at')->nullable()
                ->comment('Fecha de la tutoría');

            $table->time('started_hour_at')
                ->comment('Hora de inicio de la tutoría');

            $table->time('ended_hour_at')
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
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('tutorships');
    }
    
}
