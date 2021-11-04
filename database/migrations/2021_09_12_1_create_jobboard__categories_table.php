<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCategoriesTable extends Migration
{

    public function up()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('parent_id')
                ->nullable()
                ->comment('FK desde categories')
                ->constrained('job_board.categories');

            $table->string('code')
                ->nullable()
                ->comment('Codigo de la categoria');

            $table->string('icon')
                ->nullable()
                ->comment('Icono de la categoria');

            $table->text('name')
                ->comment('Nombre de la categoria');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_JOB_BOARD'))->dropIfExists('categories');
    }
}

