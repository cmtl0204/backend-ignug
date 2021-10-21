<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('project_plan_id')
                ->comment('FK de project_plans')
                ->constrained('uic.project_plans')
                ->nullable();
            
            $table->foreignId('mesh_student_id')
                ->comment('FK de mesh_students')
                ->constrained('uic.mesh_students');
            
            $table->json('observations')
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
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('students');
    }
}
