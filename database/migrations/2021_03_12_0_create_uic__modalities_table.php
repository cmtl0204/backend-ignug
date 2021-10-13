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
            $table->foreignId('career_id')->constrained('core.careers');
            $table->string('name')->comment('nombre modalidad PT EC');
            $table->text('description')->nullable();
            $table->foreignId('status_id')->constrained('core.status')->comment('saber vigencia');
            
        });
    }

    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('modalities');
    }
}
