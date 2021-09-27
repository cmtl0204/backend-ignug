<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE'))->create('applications', function (Blueprint $table){
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('employee_id')
                ->comment('Id del empleado que realiza la licencia o permiso')
                ->constrained('permission.employees');

            $table->foreignId('reason_id')
                ->comment('Id de las razones por la cula se realiza la licencia o permiso')
                ->constrained('permission.reasons');

            $table->foreignId('location_id')
                ->comment('Id de la localización')
                ->constrained('core.locations');

            $table->foreignId('type')
                ->comment('catalogues, para saber si es por fechas o por horas el permiso')
                ->constrained('core.catalogues');

            $table->date('date_started_at')
                ->comment('Fecha de inicio de la Licencia o Permiso');

            $table->date('date_ended_at')
                ->comment('Fecha final de la Licencia o Permiso');

            $table->time('time_started_at')
                ->comment('Hora de inicio de la Licencia o Permiso');

            $table->time('time_ended_at')
                ->comment('Hora final de la Licencia o Permiso');

            $table->json('observations')
                ->comment('Listado de observaciones');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(env('DB_CONNECTION_LICENSE'))->dropIfExists('applications');
    }
}
