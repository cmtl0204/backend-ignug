<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTeachersTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')
                // ->unique()
                ->constrained('authentication.users');
            
            $table->foreignId('teaching_ladder_id')
                ->constrained('core.catalogues');
            
            $table->foreignId('dedication_time_id')
                ->constrained('core.catalogues');
            
            $table->foreignId('higher_education_id')
                ->comment('el docente esta cursando estudios superiores escoger')
                ->nullable()
                ->constrained('core.catalogues');
            
            $table->foreignId('country_higher_education_id')
                ->comment('pais de los estudios superiores')
                ->nullable()
                ->constrained('core.catalogues');
            
            $table->foreignId('scholarship_id')
                ->comment('posee beca')
                ->nullable()
                ->constrained('core.catalogues');
            
            $table->foreignId('scholarship_type_id')
                ->comment('tipo de beca')
                ->nullable()
                ->constrained('core.catalogues');
            
            $table->foreignId('financing_type_id')
                ->comment('tipo de financiamiento de la beca')
                ->nullable()
                ->constrained('core.catalogues');
            
            $table->integer('total_subjects')->nullable();
            
            $table->integer('hours_worked')->comment('horas laboradas en la semana')->nullable();
            
            $table->integer('class_hours')->comment('horas clase en la semana')->nullable();
            
            $table->integer('investigation_hours')->comment('horas investigacion en la semana')->nullable();
            
            $table->integer('administrative_hours')->comment('horas administrativas en la semana')->nullable();
            
            $table->integer('community_hours')->comment('horas vinculacion en la semana')->nullable();
            
            $table->integer('other_hours')->comment('horas de otras actividades en la semana')->nullable();
            
            $table->integer('total_publications')->comment('total publicaciones en revistas indexadas')->default(0);
            
            $table->double('scholarship_amount')->comment('monto de la beca')->default(0);
            
            $table->boolean('technical')->comment('el docente da clases en carreras tecnicas')->default(false);
            
            $table->boolean('technology')->comment('el docente da clases en carreras tecnlogicas')->default(false);
            
            $table->boolean('sabbatical')->comment('el docente esta en periodo sabatico')->default(false);
            
            $table->boolean('publications')->comment('tiene publicaciones en revistas indexadas')->default(false);
            
            $table->string('academic_unit')->nullable();
            
            $table->string('institution_higher_education')->comment('nombre de la institucion de los estudios superiores')->default('NA');
            
            $table->string('degree_higher_education')->comment('pais de los estudios superiores')->nullable();
            
            $table->date('start_sabbatical')->comment('fecha inicio periodo sabatico')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('teachers');
    }
}
