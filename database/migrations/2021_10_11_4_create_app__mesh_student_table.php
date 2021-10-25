<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMeshStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('mesh_student', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreignId('mesh_id')
                ->constrained('app.meshes');

            $table->foreignId('student_id')
                ->constrained('uic.students');
            
            $table->date('started_cohort')
                ->nullable()
                ->comment('cohorte de ingreso');
            
            $table->date('ended_cohort')
                ->nullable()
                ->comment('cohorte de salida');
            
            $table->boolean('graduated')
                ->nullable()
                ->comment('true si ya está graduado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('mesh_student');
    }
}
