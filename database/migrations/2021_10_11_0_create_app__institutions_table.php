<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->create('institutions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('address_id')
                ->nullable()
                ->comment()
                ->constrained('core.address');
            
            $table->string('code')->unique()->comment('Generado automaticamente por el acronym y el id ej: abc1');
            
            $table->string('denomination')->nullable();
            
            $table->string('name')->unique();
            
            $table->string('short_name')->unique();
            
            $table->string('acronym')->nullable();
            
            $table->email('email')->nullable()->comment('correo electronico principal');
            
            $table->text('slogan')->nullable();
            
            $table->string('logo')->nullable();
            
            $table->string('web')->nullable();
            
            $table->string('codigo_sniese', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_APP'))->dropIfExists('institutions');
    }
}
