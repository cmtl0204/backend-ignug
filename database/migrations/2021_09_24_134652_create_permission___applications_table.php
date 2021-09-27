<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION'))->create('applications', function (Blueprint $table){
            $table->id();

            $table->foreignId('employee_id')
                ->comment('Id del empleado que realiza la licencia o permiso')
                ->constrained('permission.employees');
            $table->foreignId('reason_id')
                ->comment('Id de las razones por la cula se realiza la licencia o permiso')
                ->constrained('permission.reasons');
            $table->foreignId('location_id')
                ->comment('Id de la localización')
                ->constrained('permission.locations');
            $table->foreignId('type')
                ->comment('catalogues, para saber si es por fechas o por horas el permiso')
                ->constrained('permission.types');

            $table->date('start_date')
                ->comment('Fecha de inicio de la Licencia o Permiso');
            $table->date('end_date')
                ->comment('Fecha final de la Licencia o Permiso');
            $table->time('start_time')
                ->comment('Hora de inicio de la Licencia o Permiso');
            $table->time('end_time')
                ->comment('Hora final de la Licencia o Permiso');
            $table->text('observations')
                ->comment('Listado de observaciones');

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
        Schema::connection(env('DB_CONNECTION'))->dropIfExists('applications');
    }
}
