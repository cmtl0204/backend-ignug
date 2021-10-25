<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicModalitiesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('modalities', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreignId('parent_id')
                ->nullable()
                ->comment('FK de modalities')
                ->constrained('uic.modalities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('state_id')
                ->comment('FK de states: saber vigencia')
                ->constrained('core.states');

            $table->string('name')
                ->comment('nombre modalidad PT EC');

            $table->text('description')
                ->nullable()
                ->comment('nombre modalidad');            
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('modalities');
    }
}
