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
                ->comment('FK de modalities: saber si perdio, anulo')
                ->constrained('uic.modalities');

            $table->foreignId('school_period_id')
                ->comment('FK de status: saber si perdio, anulo')
                ->constrained('app.school_periods');

            $table->foreignId('mesh_student_id')
                ->comment('FK de status: saber si perdio, anulo')
                ->constrained('app.mesh_student');

            $table->foreignId('status_id')
                ->comment('FK de status: saber si perdio, anulo')
                ->constrained('app.status');

            $table->foreignId('planning_id')
                ->comment('saber el evento al que pertenece')
                ->constrained('uic.plannings');

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
