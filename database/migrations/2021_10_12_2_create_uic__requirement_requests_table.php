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
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('requirement_id')->constrained('uic.requirements')
            ->comment('FK requisito: true si es requerido');
            $table->foreignId('mesh_student_id')->constrained('app.mesh_student')
            ->comment('FK de malla a la que pertenece el estudiante');
            
            $table->date('date');
            $table->boolean('approved')
                ->comment('true si es requerido');
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
        Schema::connection('pgsql-uic')->dropIfExists('requirement_requests');
    }
}
