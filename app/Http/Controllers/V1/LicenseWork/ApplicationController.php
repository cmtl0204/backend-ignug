<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LicenseWork\Applications\DestroysApplicationRequest;
use App\Http\Requests\V1\LicenseWork\Applications\IndexApplicationRequest;
use App\Http\Requests\V1\LicenseWork\Applications\StoreApplicationRequest;
use App\Http\Requests\V1\LicenseWork\Applications\UpdateApplicationRequest;
use App\Http\Resources\V1\LicenseWork\ApplicationCollection;
use App\Http\Resources\V1\LicenseWork\ApplicationResource;
use App\Models\Core\Catalogue;
use App\Models\Core\Location;
use App\Models\Core\State;
use App\Models\LicenseWork\Application;
use App\Models\LicenseWork\Employee;
use App\Models\LicenseWork\Form;
use App\Models\LicenseWork\Reason;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexApplicationRequest $request)
    {

        $applications = Application::paginate($request->per_page);

        return (new ApplicationCollection($applications))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationRequest $request)
    {
        $application = new Application();
        $application->employee()
            ->associate(Employee::find($request->input('employee.id')));

        $application->reason()
            ->associate(Reason::find($request->input('reason.id')));

        $application->location()
            ->associate(Location::find($request->input('location.id')));

        $application->type()
            ->associate(Catalogue::find($request->input('type.id')));

        $application->form()
            ->associate(Form::find($request->input('form.id')));

        $application->date_started_at = $request->input('dateStartedAt');
        $application->date_ended_at = $request->input('dateEndedAt');
        $application->time_started_at = $request->input('timeStartedAt');
        $application->time_ended_at = $request->input('timeEndedAt');
        $application->observations = $request->input('observations');
        $application->save();

        return (new ApplicationResource($application))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return (new ApplicationResource($application))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->employee()
            ->associate(Employee::find($request->input('employee.id')));

        $application->reason()
            ->associate(Reason::find($request->input('reason.id')));

        $application->location()
            ->associate(Location::find($request->input('location.id')));

        $application->type()
            ->associate(Catalogue::find($request->input('type.id')));

        $application->form()
            ->associate(Form::find($request->input('form.id')));

        $application->date_started_at = $request->input('dateStartedAt');
        $application->date_ended_at = $request->input('dateEndedAt');
        $application->time_started_at = $request->input('timeStartedAt');
        $application->time_ended_at = $request->input('timeEndedAt');
        $application->observations = $request->input('observations');

        $application->save();

        return (new ApplicationResource($application))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return (new ApplicationResource($application))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroys(DestroysApplicationRequest $request)
    {
        $applications = Application::whereIn('id', $request->input('ids'))->get();
        Application::destroy($request->input('ids'));

        return (new ApplicationCollection($applications))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
// seleccionar si es de licencia o permiso
    public function selectLicenseWork ()
    {
        return "licencia o permiso";
    }
// cuando el docente va a solicitar el permiso
    public function storeApplication(StoreApplicationRequest $request)
    {
        $application = new Application();
        $application->employee()
            ->associate(Employee::find($request->input('employee.id')));

        $application->reason()
            ->associate(Reason::find($request->input('reason.id')));

        $application->location()
            ->associate(Location::find($request->input('location.id')));

        $application->type()
            ->associate(Catalogue::find($request->input('type.id')));

        $application->form()
            ->associate(Form::find($request->input('form.id')));

        $application->date_started_at = $request->input('dateStartedAt');
        $application->date_ended_at = $request->input('dateEndedAt');
        $application->time_started_at = $request->input('timeStartedAt');
        $application->time_ended_at = $request->input('timeEndedAt');
        $application->observations = $request->input('observations');
        $application->save();
        $state = State::firstWhere('code','PROCESS');
        $application->states()->attch($state);

        return (new ApplicationResource($application))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }
    // Guardar el formulario en la bandeja de formularios del empleado
    public function saveApplication ()
    {
        return "guardar el formulario";
    }
    // subir el justificacion
    public function uploadJustification (){
        return "justificado cargado";
    }
    // generar el pdf cuando el empleado lo solicite
    public function generateDocument (){
        return "PDF generado";
    }
    // seleccionar la razon por la cual se esta solicitando la licencia o permiso
    public function selectReason(){
        return "Razon de la licencia o permiso";
    }
    //subir solicitud firmada
    public function uploadSignedDocument(){
        return "Documento firmado subido";
    }
}
