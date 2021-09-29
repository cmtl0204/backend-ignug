<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseFormStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE'))->create('form_state', function (Blueprint $table){
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('form_id')
            ->comment('FK del formulario')
            ->constrained('license.forms');

            $table->foreignId('state_id')
            ->comment('Fk del estado')
            ->constrained('license.states');

            $table->foreignId('dependence_user_id')
            ->comment('FK de la Licencia')
            ->constrained('license.dependence_user');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
            Schema::connection(env('DB_CONNECTION_LICENSE'))->dropIfExists('form_state');
        }
    }