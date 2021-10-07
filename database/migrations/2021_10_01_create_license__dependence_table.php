<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseDependenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE_WORK'))->create('dependences', function ($table) {
            $table->id();

            $table->string('name')
             ->comment('Coordinacion, Administracion, Rectorado');

            $table->integer('level')
             ->comment('1,2,3,4');

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE_WORK'))->dropIfExists('dependences');         
    }
}
