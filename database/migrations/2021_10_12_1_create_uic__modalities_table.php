<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicModalitiesTable extends Migration
{

    public function up()
    {
        Schema::connection(.env('DB_CONNECTION_UIC'))->create('modalities', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreignId('parent_id')->references('id')->on('modalities')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('status_id')
                ->constrained('core.status')
                ->comment('FK de status: saber vigencia');
            
            $table->foreignId('career_id')
                ->constrained('core.careers')
                ->comment('FK de status: nombre carrera');

            $table->string('name')
                ->comment('FK de status: nombre modalidad PT EC');

            $table->text('description')->nullable()
                ->comment('FK de status: nombre modalidad ');            
        });
    }

    public function down()
    {
        Schema::connection('DB_CONNECTION_UIC')->dropIfExists('modalities');
    }
}
