<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppCareersTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('careers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('institution_id')
                ->constrained('app.institutions');
            
            $table->foreignId('modality_id')
                ->constrained('uic.modalities');
            
            $table->foreignId('type_id')
                ->constrained('core.catalogues');
            
            $table->string('code')->nullable();;
            
            $table->string('name')->nullable();
            
            $table->text('description')->nullable();
            
            $table->string('short_name');
            
            $table->string('resolution_number')->nullable();
            
            $table->string('title');
            
            $table->string('acronym');
            
            $table->string('logo');
            
            $table->json('learning_results')->nullable();

            $table->string('codigo_sniese', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('careers');
    }
}
