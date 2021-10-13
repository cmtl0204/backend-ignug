<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicPlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(.env('DB_CONNECTION_UIC'))->create('plannings', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('career_id')->constrained('core.careers');
            $table->string('name')->nullable()->comment('UIC 2021-1');
            $table->date('start_date')->comment('fecha inicio');
            $table->date('end_date')->comment('fecha fin');
            $table->string('description')->nullable()->comment('descripcion evento');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql-uic')->dropIfExists('plannings');
    }
}
