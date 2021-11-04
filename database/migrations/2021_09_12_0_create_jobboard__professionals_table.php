<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardProfessionalsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('professionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')
                ->comment('FK desde users')
                ->constrained('authentication.users');

            $table->text('about_me')
                ->nullable()
                ->comment('escribir una breve presentación');

            $table->boolean('catastrophic_diseased')
                ->default(false)
                ->comment('Para saber si el profesional tiene una enfermedad catastrofica, true=>tiene false=no tiene');

            $table->boolean('disabled')
                ->default(false)
                ->comment('Para saber si el profesional tiene una discapacidad, true=>tiene false=no tiene');

            $table->boolean('familiar_catastrophic_diseased')
                ->default(false)
                ->comment('Para saber si el profesional tieneun familiar con una enfermedad catastrofica, true=>tiene false=no tiene');

            $table->boolean('familiar_disabled')
                ->default(false)
                ->comment('Para saber si el profesional tiene un familiar con una discapacidad, true=>tiene false=no tiene');

            $table->string('identification_familiar_disabled')
                ->nullable()
                ->comment('escriba número de identificación');

            $table->boolean('traveled')
                ->default(false)
                ->comment('Para saber si puede viajar o no el profesional, true=>puede false=no puede');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('professionals');
    }
}
