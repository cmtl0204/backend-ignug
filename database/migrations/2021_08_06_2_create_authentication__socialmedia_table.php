<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationSocialmediaTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('socialmedia', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('socialmedia');
    }
}
