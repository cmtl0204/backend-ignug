<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationSystemsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('systems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('code')->comment('No debe ser modificado una vez creado');
            $table->string('name');
            $table->string('acronym');
            $table->text('description')->nullable();
            $table->string('icon')->nullable()->comment('De la libreria que se usa en el frontend');
            $table->string('version')->comment('XX.XX.XX');
            $table->string('redirect')->comment('pagina wen de redireccion del cliente');
            $table->date('date')->comment('Fecha del sistema');
            $table->boolean('state')->default(true)->comment('true activo false inactivo');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('systems');
    }
}
