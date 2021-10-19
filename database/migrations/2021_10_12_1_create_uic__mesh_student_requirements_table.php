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
                ->comment('FK de mesh_student ')            
                ->constrained('app.mesh_student');
                
            $table->foreignId('requirement_id')
                ->comment('FK de requirement ')
                ->constrained('uic.requirements');

            $table->boolean('approved')
                ->comment('Para saber si es aprovado')
                ->nullable();

            $table->json('observations')
                ->comment('Observaciónes')
                ->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('mesh_student_requirements');
    }
}
