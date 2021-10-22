<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMeshesTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('meshes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('career_id')
            ->constrained('app.careers');
            
            $table->string('name')->nullable();
            
            $table->date('started_at')->nullable();
            
            $table->date('ended_at')->nullable();
            
            $table->string('resolution_number')->nullable();
            
            $table->integer('number_weeks')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('meshes');
    }
}
