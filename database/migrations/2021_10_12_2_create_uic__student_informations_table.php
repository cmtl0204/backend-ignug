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
                ->constrained('app.students')
                ->comment('FK de students');

            $table->foreignId('relation_laboral_career_id')
                ->constrained('core.catalogues')
                ->nullable()
                ->comment('FK de catalogues');

            $table->foreignId('company_area_id')
                ->constrained('core.catalogues')
                ->nullable()
                ->comment('FK de catalogues');

            $table->foreignId('company_position_id')
                ->constrained('core.catalogues')
                ->nullable()
                ->comment('FK de catalogues');
            
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
