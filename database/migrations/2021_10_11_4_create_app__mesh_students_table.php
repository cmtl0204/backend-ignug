<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMeshStudentTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('mesh_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreignId('mesh_id')
                ->constrained('app.meshes');
            
            $table->date('cohort_started_at')
                ->nullable()
                ->comment('cohorte de ingreso');
            
            $table->date('cohort_ended_at')
                ->nullable()
                ->comment('cohorte de salida');
            
            $table->boolean('graduated')
                ->nullable()
                ->comment('true si ya está graduado');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('mesh_students');
    }
}
