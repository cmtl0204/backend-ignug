<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreLocationsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_CORE'))->create('locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('type_id')
                ->nullable()
                ->constrained('core.catalogues');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('core.locations');

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
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_CORE'))->dropIfExists('locations');
    }
}
