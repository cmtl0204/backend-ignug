<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUicEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('planning_id')
                ->comment('FK de plannings')
                ->constrained('uic.plannings');

            $table->foreignId('name_id')
                ->comment('FK de catalogues')
                ->constrained('app.catalogues');

            $table->date('startedAt')
                ->comment('fecha inicio');

            $table->date('endedAt')
                ->comment('fecha fin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_UIC'))->dropIfExists('events');
    }
}
