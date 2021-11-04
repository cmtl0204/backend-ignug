<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardReferencesTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('references', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('professional_id')
                ->comment('FK desde professionals')
                ->constrained('job_board.professionals');

            $table->string('contact_email')
                ->comment('email del contacto');

            $table->string('contact_name')
                ->comment('nombre del contacto');

            $table->string('contact_phone')
                ->comment('celular del contacto');

            $table->string('institution')
                ->comment('institución');

            $table->string('position')
                ->comment('posicion');
        });

    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('references');
    }
}
