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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('mesh_student_id')->constrained('core.mesh_student');
            $table->foreignId('requirement_id')->constrained('uic.requirements');
            $table->boolean('is_approved')->nullable();
            $table->text('observations')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('mesh_student_requirements');
    }
}
