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
                ->constrained('uic.project_plans')
                ->nullable()
                ->comment('FK de project_plans');
            
                $table->foreignId('mesh_student_id')
                ->constrained('app.mesh_student')
                ->comment('FK de mesh_student');
            
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