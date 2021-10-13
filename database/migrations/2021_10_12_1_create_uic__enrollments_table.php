<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicEnrollmentsTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('modality_id')
                ->constrained('uic.modalities')
                ->comment('FK de modalities: saber si perdio, anulo');

            $table->foreignId('school_period_id')
                ->constrained('app.school_periods')
                ->comment('FK de status: saber si perdio, anulo');

            $table->foreignId('mesh_student_id')
                ->constrained('app.mesh_student')
                ->comment('FK de status: saber si perdio, anulo');

            $table->foreignId('status_id')
                ->constrained('app.status')
                ->comment('FK de status: saber si perdio, anulo');

            $table->foreignId('planning_id')
                ->constrained('uic.plannings')
                ->comment('saber el evento al que pertenece');

            $table->date('registered_at')
                ->comment('Fecha matrícula');

            $table->string('code')
                ->comment('');

            $table->json('observations')
                ->nullable()
                ->comment('');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('enrollments');
    }
}
