<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSchoolPeriodsTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('school_periods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('state_id')
                ->constrained('core.states');
            
            $table->string('code')->unique();
            
            $table->string('name');
            
            $table->date('started_at');
            
            $table->date('ended_at')->nullable();
            
            $table->date('ordinary_started_at');
            
            $table->date('ordinary_ended_at');
            
            $table->date('extraordinary_started_at');
            
            $table->date('extraordinary_ended_at');
            
            $table->date('especial_started_at');
            
            $table->date('especial_ended_at');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('school_periods');
    }
}
