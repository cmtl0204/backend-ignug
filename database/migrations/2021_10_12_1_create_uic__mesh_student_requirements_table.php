<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicMeshStudentRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('mesh_student_requirements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('mesh_student_id')
                ->constrained('app.mesh_student')
                ->comment('FK desde mesh_student ');

            $table->foreignId('requirement_id')
                ->constrained('uic.requirements')
                ->comment('FK desde requirement ');

            $table->boolean('is_approved')
                ->nullable()
                ->comment('Para saber si es aprovado');

            $table->text('observations')
                ->nullable()
                ->comment('Observaciones');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('DB_CONNECTION_UIC')->dropIfExists('mesh_student_requirements');
    }
}
