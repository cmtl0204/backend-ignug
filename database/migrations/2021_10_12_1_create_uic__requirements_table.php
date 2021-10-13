<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up() 
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('requirements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('career_id')
                ->constrained('app.careers')
                ->comment('FK desde career');

            $table->string('name')
                ->comment('Nombre');

                $table->boolean('is_required')
                ->comment('true si es requerido');
                
            $table->boolean('is_solicitable')
                ->comment('para saber si la institución puede otorgar el requerimiento');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('requirements');
    }
}
