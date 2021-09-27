<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('reasons', function (Blueprint $table) {
            $table->id();

            $table->string( 'name ')
              ->comment('reason name');
            $table->string('description_one ')
              ->comment('Maternity: can be three to six months');
            $table->string( 'description_two')
              ->comment('Maternity: by healthy that be dificult to work');
            $table->bolean('discountable_holidays')
              ->default(false)
              ->comment('If it is discountable true otherwise false');
            $table->integer('days_minimun')
               ->comment('minimum days to request permission');
            $table->integer('days_highs')
               ->comment('maximum days to justify');
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
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('reasons');
    }
}

