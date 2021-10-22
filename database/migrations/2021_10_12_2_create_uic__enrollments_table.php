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
                ->constrained('uic.modalities');
            
            $table->foreignId('school_period_id')
                ->constrained('app.school_periods');
            
            $table->foreignId('mesh_student_id')
                ->constrained('app.mesh_student');
            
            $table->foreignId('state_id')
                ->comment('FK de states, saber si perdio, anulo')
                ->constrained('core.states');
            
            $table->foreignId('planning_id')
                ->comment('saber el evento al que pertenece')
                ->constrained('uic.plannings');
            
            $table->date('registered_at')->comment('fecha matricula');
            
            $table->string('code');
            
            $table->json('observations')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('enrollments');
    }
}
