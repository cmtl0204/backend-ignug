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
        Schema::connection('pgsql-uic')->create('tutor_ships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained('uic.tutors');
            $table->foreignId('enrollment_id')->constrained('uic.enrollments');
            $table->json('topics')->nullable();
            $table->date('date')->nullable();
            $table->time('start_hour');
            $table->time('end_hour');
            $table->time('duration');
            $table->integer('percentage_advance')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('tutor_ship');
    }
    
}
