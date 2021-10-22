<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('enrollment_id')
                ->constrained('uic.enrollments');
            
            $table->foreignId('project_plan_id')
                ->constrained('uic.project_plans');
            
            $table->string('title')
                ->comment('titulo');
            
            $table->string('description');
            
            $table->integer('score');
            
            $table->integer('total_advance')
                ->default(0);
            
            $table->boolean('approved');
            
            $table->boolean('tutor_asigned')
                ->default(false);
            
            $table->json('observations')
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
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('projects');
    }
}
