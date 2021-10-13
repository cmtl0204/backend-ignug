<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('tutors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('project_plan_id')
                ->nullable()
                ->constrained('uic.project_plans')
                ->comment('FK de career');

            $table->foreignId('teacher_id')
                ->constrained('app.teachers')
                ->comment('FK de teacher: id de la tabla');

            $table->foreignId('type_id')
                ->constrained('core.catalogues')
                ->comment('FK de type: para saber si es tutor, revisor ,etc');

            $table->json('observations')
                ->comment('registro de cambios')
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
        Schema::connection('DB_CONNECTION_UIC')->dropIfExists('tutors');
    }
}
