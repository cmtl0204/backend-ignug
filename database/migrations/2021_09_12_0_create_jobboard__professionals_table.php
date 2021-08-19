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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained('authentication.users')
                ->comment('FK desde users');

            $table->boolean('traveled')
                ->default(false)
                ->comment('Para saber si puede viajar o no el profesional, true=>puede false=no puede');

            $table->boolean('disabled')
                ->default(false);

            $table->boolean('familiar_disabled')
                ->default(false);

            $table->string('identification_familiar_disabled')
                ->nullable()
                ->comment('escriba número de identificación');

            $table->boolean('catastrophic_diseased')
                ->default(false);

            $table->boolean('familiar_catastrophic_diseased')->default(false);

            $table->text('about_me')
                ->nullable()
                ->comment('escribir una breve presentación');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('professionals');
    }
}