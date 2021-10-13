<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicStudentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('student_informations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreignId('student_id')
                ->comment('FK de students')
                ->constrained('app.students');

            $table->foreignId('relation_laboral_career_id')
                ->comment('FK de catalogues')
                ->constrained('core.catalogues')
                ->nullable();

            $table->foreignId('company_area_id')
                ->comment('FK de catalogues')
                ->constrained('core.catalogues')
                ->nullable();

            $table->foreignId('company_position_id')
                ->comment('FK de catalogues')
                ->constrained('core.catalogues')
                ->nullable();
            
            $table->string('company_work')
                ->nullable()
                ->comment('Nombre de la empresa donde labora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('student_informations');
    }
}
