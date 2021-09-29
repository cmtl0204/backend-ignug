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
        Schema::connection(env('DB_CONNECTION_LICENSE_WORK'))->create('form_state', function (Blueprint $table){
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('form_id')
            ->comment('FK del formulario')
            ->constrained('license_work.forms');

            $table->foreignId('state_id')
            ->comment('Fk del estado')
            ->constrained('license_work.states');

            $table->foreignId('dependence_user_id')
            ->comment('FK de la Licencia');
//            ->constrained('license_work.dependence_user');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
            Schema::connection(env('DB_CONNECTION_LICENSE_WORK'))->dropIfExists('form_state');
        }
    }
