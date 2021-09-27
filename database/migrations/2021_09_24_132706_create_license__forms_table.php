<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE'))->create('forms', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->string('code')
            ->comment('Código del formulario');

            $table->text('description')
            ->comment('Formulario de Licencias y Permisos');

            $table->string('regime')
            ->comment('Losep.Cod.trabajo');

            $table->float('days_const')
            ->default(135/99)
            ->comment('1.363636');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('forms');
    }
}
