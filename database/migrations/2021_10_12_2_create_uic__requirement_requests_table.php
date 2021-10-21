<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicRequirementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('requirement_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('requirement_id')
                ->comment('FK de requirements: true si es requerido')
                ->constrained('uic.requirements');

            $table->foreignId('mesh_student_id')
                ->comment('FK de mesh_students, de malla a la que pertenece el estudiante')
                ->constrained('uic.mesh_students');
            
            $table->date('registered_at')
                ->comment('true si es requerido');

            $table->boolean('approved')
                ->comment('¿Está aprobado?');

            $table->json('observations')
                ->nullable()
                ->comment('true si es requerido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('requirement_requests');
    }
}
