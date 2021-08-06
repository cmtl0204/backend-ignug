<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationLocationsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('locations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type_id')
                ->nullable()
                ->constrained('authentication.catalogues');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('authentication.locations');

            $table->string('code');

            $table->string('name');

            $table->string('alpha2_code')
                ->nullable();

            $table->string('alpha3_code')
                ->nullable();

            $table->string('region')
                ->nullable();

            $table->string('subregion')
                ->nullable();

            $table->string('calling_code')
                ->nullable();

            $table->string('capital')
                ->nullable();

            $table->string('top_level_domain')
                ->nullable();

            $table->string('flag')
                ->nullable();

            $table->json('timezones')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('locations');
    }
}
