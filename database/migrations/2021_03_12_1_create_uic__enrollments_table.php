<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicEnrollmentsTable extends Migration
{

    public function up()
    {
        Schema::connection(.env('DB_CONNECTION_UIC'))->create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('modality_id')->constrained('uic.modalities');
            $table->foreignId('school_period_id')->constrained('core.school_periods');
            $table->foreignId('mesh_student_id')->constrained('core.mesh_student');
            $table->foreignId('status_id')->constrained('core.status')->comment('saber si perdio, anulo');
            $table->foreignId('planning_id')->constrained('uic.plannings')->comment('saber el evento al que pertenece');
            $table->date('date')->comment('fecha matricula');
            $table->string('code');
            $table->json('observations')->nullable(); 
        });
    }

    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('enrollments');
    }
}
