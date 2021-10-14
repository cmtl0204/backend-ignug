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
                ->comment('FK de modalities')
                ->constrained('uic.modalities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('status_id')
                ->comment('FK de status: saber vigencia')
                ->constrained('app.status');
            
            $table->foreignId('career_id')
                ->comment('FK de status: nombre carrera')
                ->constrained('app.careers');

            $table->string('name')
                ->comment('FK de status: nombre modalidad PT EC');

            $table->text('description')
                ->nullable()
                ->comment('FK de status: nombre modalidad ');            
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('modalities');
    }
}
