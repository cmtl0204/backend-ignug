<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE'))->create('reasons', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2021_09_24_135244_create_license__reasons_table.php
            $table->softDeletes();
            $table->timestamps();

            $table->string('name')
=======

            $table->string( 'name ')
>>>>>>> 0a68ee059c17859d8413b0251d7298fabbd8ba1d:database/migrations/2021_09_24_135244_create_permission__reasons_table.php
              ->comment('reason name');

            $table->string('description_one')
              ->comment('Maternity: can be three to six months');

            $table->string( 'description_two')
              ->comment('Maternity: by healthy that be dificult to work');

            $table->boolean('discountable_holidays')
              ->default(false)
              ->comment('If it is discountable true otherwise false');

            $table->integer('days_min')
               ->comment('minimum days to request permission');
               
            $table->integer('days_max')
               ->comment('maximum days to justify');
            
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2021_09_24_135244_create_license__reasons_table.php
        Schema::connection(env('DB_CONNECTION_LICENSE'))->dropIfExists('reasons'); 
=======
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('reasons');
>>>>>>> 0a68ee059c17859d8413b0251d7298fabbd8ba1d:database/migrations/2021_09_24_135244_create_permission__reasons_table.php
    }
}

