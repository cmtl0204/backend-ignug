<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('identification_type_id')->nullable()->constrained('core.catalogues');
            $table->foreignId('sex_id')->nullable()->constrained('core.catalogues');
            $table->foreignId('gender_id')->nullable()->constrained('core.catalogues');
            $table->foreignId('ethnic_origin_id')->nullable()->constrained('core.catalogues');
            $table->foreignId('blood_type_id')->nullable()->constrained('core.catalogues');
            $table->foreignId('civil_status_id')->nullable()->constrained('core.catalogues');
            $table->string('avatar')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->date('birthdate')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('password_changed')->default(false);
            $table->integer('max_attempts')->default(\App\Models\Authentication\User::MAX_ATTEMPTS);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('users');
    }
}
