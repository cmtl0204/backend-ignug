<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicCareerModalityTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('career_modality', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreignId('career_id')
                ->comment('FK de careers')
                ->constrained('app.careers');
            
            $table->foreignId('modality_id')
                ->comment('FK de modalities')
                ->constrained('uic.modalities');
            
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('career_modality');
    }
}
